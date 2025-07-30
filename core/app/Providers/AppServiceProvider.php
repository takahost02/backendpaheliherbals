<?php

namespace App\Providers;

use URL;
use App\Models\User;
use App\Lib\Searchable;
use App\Models\Deposit;
use App\Models\Frontend;
use App\Constants\Status;
use App\Models\Withdrawal;
use App\Models\SupportTicket;
use App\Models\AdminNotification;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Builder::mixin(new Searchable);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (!cache()->get('SystemInstalled')) {
            $envFilePath = base_path('.env');
            if (!file_exists($envFilePath)) {
                header('Location: install');
                exit;
            }
            $envContents = file_get_contents($envFilePath);
            if (empty($envContents)) {
                header('Location: install');
                exit;
            } else {
                cache()->put('SystemInstalled', true);
            }
        }

        $activeTemplate = activeTemplate();
        $viewShare['activeTemplate'] = $activeTemplate;
        $viewShare['activeTemplateTrue'] = activeTemplate(true);
        $viewShare['emptyMessage'] = 'Data not found';
        view()->share($viewShare);

        view()->composer('admin.partials.sidenav', function ($view) {
            $view->with([
                'bannedUsersCount'           => User::banned()->count(),
                'emailUnverifiedUsersCount' => User::emailUnverified()->count(),
                'mobileUnverifiedUsersCount' => User::mobileUnverified()->count(),
                'kycUnverifiedUsersCount'   => User::kycUnverified()->count(),
                'kycPendingUsersCount'      => User::kycPending()->count(),
                'pendingTicketCount'        => SupportTicket::whereIn('status', [Status::TICKET_OPEN, Status::TICKET_REPLY])->count(),
                'pendingDepositsCount'      => Deposit::pending()->count(),
                'pendingWithdrawCount'      => Withdrawal::pending()->count(),
                'updateAvailable'           => version_compare(gs('available_version'), systemDetails()['version'], '>') ? 'v' . gs('available_version') : false,
            ]);
        });

        view()->composer('admin.partials.topnav', function ($view) {
            $view->with([
                'adminNotifications'      => AdminNotification::where('is_read', Status::NO)->with('user')->orderBy('id', 'desc')->take(10)->get(),
                'adminNotificationCount'  => AdminNotification::where('is_read', Status::NO)->count(),
            ]);
        });

        view()->composer('partials.seo', function ($view) {
            $seo = Frontend::where('data_keys', 'seo.data')->first();
            $view->with([
                'seo' => $seo ? $seo->data_values : $seo,
            ]);
        });

        if (gs('force_ssl')) {
            URL::forceScheme('https');
        }

        Paginator::useBootstrapFive();

        $mailConfig = json_decode(json_encode(gs('mail_config')), true); // convert object to array

        // In AppServiceProvider's boot method
        if ($mailConfig && isset($mailConfig['name'])) {
            Config::set('mail.default', $mailConfig['name']);
        
            if ($mailConfig['name'] === 'smtp') {
                Config::set('mail.mailers.smtp', [
                    'transport'  => 'smtp',
                    'host'       => $mailConfig['host'],
                    'port'       => $mailConfig['port'],
                    'encryption' => $mailConfig['enc'] ?? null,
                    'username'   => $mailConfig['username'],
                    'password'   => $mailConfig['password'],
                    'timeout'    => 30, // Increased timeout
                    'auth_mode'  => ($mailConfig['auth'] ?? 'true') === 'true' ? null : false,
                ]);
            }
        
            Config::set('mail.from.address', $mailConfig['email_from'] ?? env('MAIL_FROM_ADDRESS'));
            Config::set('mail.from.name', $mailConfig['email_from_name'] ?? config('app.name'));
        }
    }
}
