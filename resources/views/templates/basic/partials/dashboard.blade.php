<section class="user-dashboard padding-top padding-bottom">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="dashboard-sidebar">
                    <div class="close-dashboard d-lg-none">
                        <i class="las la-times"></i>
                    </div>
                    <div class="dashboard-user">
                        <div class="user-thumb" style="border: 9px solid green; display: inline-block; border-radius: 50%; overflow: hidden;">
                            <img id="output" 
                                 src="{{ getImage('assets/images/user/profile/' . auth()->user()->image, '350x300', true) }}" 
                                 alt="dashboard" 
                                 style="display: block; width: 100%; height: auto;">
                        </div>

                        <div class="user-content">
                            <span>@lang('Welcome')</span>
                            <h5 class="name">{{ auth()->user()->fullname }}</h5>
                            <h5 class="username" style="color: green;">{{ auth()->user()->username }}</h5>
                        </div>
                    </div>
                    <ul class="user-dashboard-tab">
                        <li>
                            <a class="{{menuActive('user.home')}}" href="{{route('user.home')}}">@lang('Dasboard')</a>
                        </li>
                        <li>
                        <a href="{{ route('user.my.income') }}"
                           class="{{ menuActive('user.my.income') }}">
                            @lang('My Income')
                        </a>
                    </li>

                        <li>
                            <a class="{{menuActive('user.plan.index')}}" href="{{route('user.plan.index')}}"> @lang('Plan') </a>
                        </li>
                       <!-- <li>
                            <a class="{{menuActive('user.bv.log')}}" href="{{ route('user.bv.log') }}">@lang('BV Log') </a>
                        </li>-->
                        <li>
                            <a class="{{menuActive('user.my.ref')}}" href="{{ route('user.my.ref') }}"> @lang('My Referrals')</a>
                        </li>
                        
                        <li>
                            <a class="{{menuActive('user.my.team')}}" href="{{ route('user.my.team') }}"> @lang('My Team')</a>
                        </li>
                        <li>
                            <a class="{{menuActive('user.my.tree')}}" href="{{ route('user.my.tree') }}">@lang('My Tree')</a>
                        </li>
                        <!--<li>
                            <a href="{{ route('user.royalty.summery') }}"
                               class="{{ menuActive('user.royalty.summery') }}">
                                @lang('Master Matching Income')
                            </a>
                        </li>-->

                        
                        
                        <li>
                            <a href="{{ route('user.binary.summery') }}" class="{{menuActive('user.binary.summery')}}">
                                @lang('Master Matching Income')
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('user.binary.summeryhistory') }}" class="{{menuActive('user.binary.history')}}">
                                @lang('Master Matching Income History')
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('user.summery.history') }}" class="{{menuActive('user.binary.history')}}">
                                @lang('Income History')
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('user.matrix.income') }}" class="{{menuActive('user.matrix.income')}}">
                                @lang('Level Income')
                            </a>
                        </li>
                        <!--<li>
                            <a href="{{ route('user.binary.income') }}" class="{{menuActive('user.binary.income')}}">
                                @lang('Binary Income')
                            </a>
                        </li>-->
                       
                       <li>
    <a href="{{ route('user.rewards.index') }}">
        <i class="las la-gift"></i> @lang('Rewards Income')
    </a>
</li>

                
                                <li>
                    <a href="{{ route('user.rank.income') }}"
                       class="{{ menuActive('user.rank.income') }}">
                        @lang('Rank Achievement Income')
                    </a>
                </li>
                
                
                <li>
                        <a href="{{ route('user.salary.income') }}"
                           class="{{ menuActive('user.salary.income') }}">
                            @lang('Salary Income')
                        </a>
                    </li>
                    
                     <li>
                            <a href="{{ route('user.repurchase.income') }}" class="{{menuActive('user.repurchase.income')}}">
                                @lang('Repurchase Income')
                            </a>
                        </li>
                          <li>
                        <a href="{{ route('user.global.matching.income') }}"
                           class="{{ menuActive('user.global.matching.income') }}">
                            @lang('Global Matching Income')
                        </a>
                    </li>
                    
                    <li>
                        <a href="{{ route('user.franchise.income') }}"
                           class="{{ menuActive('user.franchise.income') }}">
                            @lang('Franchise Bonus Income')
                        </a>
                    </li>
                    
                   <!-- <li>
                        <a href="{{ route('user.retail.income') }}"
                           class="{{ menuActive('user.retail.income') }}">
                            @lang('Retail Profits Income')
                        </a>
                    </li>-->
                    
                  



                          
                        <li>
                            <a href="{{ route('user.orders') }}" class="{{menuActive('user.orders')}}">
                                @lang('My Order')
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('user.balance.transfer') }}" class="{{menuActive('user.balance.transfer')}}">
                                @lang('Balance Transfer')
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('user.deposit.history') }}" class="{{menuActive(['user.deposit*'])}}">
                                @lang('Deposit History')
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('user.withdraw.history') }}" class="{{menuActive('user.withdraw*')}}">
                                @lang('Withdraw History')
                            </a>
                        </li>
                       
                       <!-- <li>
                            <a href="{{ route('user.transactions') }}" class="{{menuActive('user.transactions')}}">
                                @lang('Transactions History')
                            </a>
                        </li>-->
                        <li>
                            <a href="{{ route('ticket.index') }}" class="{{menuActive('ticket*')}}">
                                @lang('Support Ticket')
                            </a>
                        </li>
                        
                        <li>
                            <a class="{{menuActive('user.profile.setting')}}" href="{{route('user.profile.setting')}}" class="">@lang('Profile Setting')</a>
                        </li>
                        <li>
                            <a href="{{ route('user.twofactor') }}" class="{{menuActive('user.twofactor')}}">
                                @lang('2FA Security')
                            </a>
                        </li>
                        
                        <li>
                    <a class="{{ menuActive('user.welcome.letter') }}"
                       href="{{ route('user.welcome.letter') }}">
                        <i class="las la-envelope-open-text"></i>
                        @lang('Welcome Letter')
                    </a>
                </li>

                        
                        <li>
                            <a class="{{menuActive('user.change.password')}}" href="{{route('user.change.password')}}" class="">@lang('Change Password')</a>
                        </li>
                        
                        <li>
                            <a href="{{ route('user.logout') }}" class="">@lang('Sign Out')</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">

                <div class="user-toggler-wrapper d-flex d-lg-none">
                    <h4 class="title">{{ __($pageTitle) }}</h4>
                    <div class="user-toggler">
                        <i class="las la-sliders-h"></i>
                    </div>
                </div>


                @yield('content')
            </div>
        </div>
    </div>
</section>