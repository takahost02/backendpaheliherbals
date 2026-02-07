<div class="user-details-modal">
    <div class="user-details-header text-center">
        <div class="thumb mb-3">
            <img src="{{ $user->image ? asset('assets/images/profile/user/' . $user->image) : asset('assets/images/default.png') }}" 
                 alt="{{ $user->username }}" 
                 class="tree_image rounded-circle" width="80" height="80">
        </div>
        <div class="content">
            <a class="user-name tree_url tree_name" href="#">{{ $user->fullname }} ({{ $user->username }})</a>
            <span class="user-status tree_status badge bg-{{ $user->status ? 'success' : 'danger' }}">
                {{ $user->status ? 'Active' : 'Inactive' }}
            </span>
            <span class="user-status tree_plan badge bg-info">{{ $user->plan->name ?? 'N/A' }}</span>
        </div>
    </div>
    <div class="user-details-body text-center">
        <h6 class="my-3">@lang('Referred By'): <span class="tree_ref">{{ $user->ref_by ? User::find($user->ref_by)->username ?? 'N/A' : 'N/A' }}</span></h6>

        <table class="table table-bordered">
            <tr>
                <th>&nbsp;</th>
                <th>@lang('LEFT')</th>
                <th>@lang('RIGHT')</th>
            </tr>

            <tr>
                <td>@lang('Current BV')</td>
                <td><span class="lbv">{{ $leftBv }}</span></td>
                <td><span class="rbv">{{ $rightBv }}</span></td>
            </tr>
            <tr>
                <td>@lang('Free Member')</td>
                <td><span class="lfree">{{ $leftMembers - $leftPaid }}</span></td>
                <td><span class="rfree">{{ $rightMembers - $rightPaid }}</span></td>
            </tr>

            <tr>
                <td>@lang('Paid Member')</td>
                <td><span class="lpaid">{{ $leftPaid }}</span></td>
                <td><span class="rpaid">{{ $rightPaid }}</span></td>
            </tr>
        </table>
        
        <div class="mt-3">
            <button class="btn btn--primary view-tree-btn" data-user-id="{{ $user->id }}">
                <i class="fas fa-sitemap"></i> @lang('View Tree')
            </button>
        </div>
    </div>
</div>