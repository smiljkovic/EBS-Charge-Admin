<nav class="sidebar-nav">

    <ul id="sidebarnav">

        <!-- <li>
            <a class="waves-effect waves-dark" href="{!! url('dashboard') !!}" aria-expanded="false">

                <i class="mdi mdi-home"></i>

                <span class="hide-menu">{{trans('lang.dashboard')}}</span>

            </a>
        </li>

        <li>
            <a class="waves-effect waves-dark" href="{!! url('map') !!}" aria-expanded="false">

                <i class="mdi mdi-home-map-marker"></i>

                <span class="hide-menu">{{trans('lang.gods_eye')}}</span>

            </a>
        </li> -->

        <li class="nav-subtitle"><span class="nav-subtitle-span">{{trans('lang.account_management')}}</span></li>

        <li>
            <a class="waves-effect waves-dark user_menu" href="{!! url('users') !!}" aria-expanded="false">

                <i class="mdi mdi-account-multiple"></i>

                <span class="hide-menu">{{trans('lang.users')}}</span>

            </a>
        </li>


        <li>
            <a class="has-arrow waves-effect waves-dark report_menu" href="#" aria-expanded="false">
                <i class="mdi mdi-calendar-check"></i>
                <span class="hide-menu">{{trans('lang.report_plural')}}</span>
            </a>
            <ul aria-expanded="false" class="collapse report_sub_menu">
                <li><a href="{!! url('reports/user') !!}">{{trans('lang.reports_user')}}</a></li>
                <li><a href="{!! url('reports/booking') !!}">{{trans('lang.reports_booking')}}</a></li>
                <li><a href="{!! url('reports/parking') !!}">{{trans('lang.reports_parking')}}</a></li>
                <li><a href="{!! url('reports/charger') !!}">{{trans('lang.reports_charger')}}</a></li>
                <li><a href="{!! url('reports/transaction') !!}">{{trans('lang.reports_transaction')}}</a></li>

            </ul>

        </li>


        <li class="nav-subtitle"><span class="nav-subtitle-span">{{trans('lang.ride_management')}}</span></li>


        <!-- <li><a class="waves-effect waves-dark parkings_menu" href="{!! url('parking-list') !!}" aria-expanded="false">
                <i class="mdi mdi-parking"></i>
                <span class="hide-menu">{{trans('lang.parking_list')}}</span>
            </a>
        </li> -->

        <li><a class="waves-effect waves-dark chargers_menu" href="{!! url('chargers-list') !!}" aria-expanded="false">
                <i class="mdi mdi-power-plug"></i>
                <span class="hide-menu">{{trans('lang.chargers_list')}}</span>
            </a>
        </li>

        <li><a class="waves-effect waves-dark bookings_menu" href="{!! url('parking-bookings') !!}"
               aria-expanded="false">
                <i class="mdi mdi-road-variant"></i>
                <span class="hide-menu">{{trans('lang.parking_orders')}}</span>
            </a>
        </li>

        <!-- Nikola - replaced parking_facilities with charging_facilities -->
        <!-- <li><a class="waves-effect waves-dark facility_menu" href="{!! url('parking-facilities') !!}"
               aria-expanded="false">
                <i class="mdi mdi-reorder-horizontal"></i>
                <span class="hide-menu">{{trans('lang.parking_facilities')}}</span>
            </a>
        </li> -->

        <li><a class="waves-effect waves-dark facility_menu" href="{!! url('charging-facilities') !!}"
               aria-expanded="false">
                <i class="mdi mdi-reorder-horizontal"></i>
                <span class="hide-menu">{{trans('lang.charging_facilities')}}</span>
            </a>
        </li>


        <li>
            <a class="has-arrow waves-effect waves-dark vehicle_menu" href="#" aria-expanded="false">
                <i class="mdi mdi-car"></i>
                <span class="hide-menu">{{trans('lang.vehicle_setting')}}</span>
            </a>
            <ul ara-expanded="false" class="collapse vehicle_sub_menu">
                <li class="brand_menu"><a href="{!! url('brand') !!}">{{trans('lang.brand')}}</a></li>
                <li class="model_menu"><a href="{!! url('model') !!}">{{trans('lang.model')}}</a></li>

            </ul>
        </li>


        <li class="nav-subtitle"><span class="nav-subtitle-span">{{trans('lang.app_management')}}</span></li>

        <li><a class="waves-effect waves-dark cms_page" href="{!! url('cms') !!}" aria-expanded="false">
                <i class="mdi mdi-book-open-page-variant"></i>
                <span class="hide-menu">{{trans('lang.cms_plural')}}</span>
            </a>
        </li>
        <li><a class="waves-effect waves-dark onboard_menu" href="{!! url('on-board') !!}" aria-expanded="false">
                <i class="mdi mdi-cellphone"></i>
                <span class="hide-menu">{{trans('lang.on_board_plural')}}</span>
            </a>
        </li>
        <li><a class="waves-effect waves-dark faq_menu" href="{!! url('faq') !!}" aria-expanded="false">
                <i class="mdi mdi-comment-question-outline"></i>
                <span class="hide-menu">{{trans('lang.faq_plural')}}</span>
            </a>
        </li>
        <li><a class="waves-effect waves-dark faq_menu" href="{!! url('coupons') !!}" aria-expanded="false">
                <i class="mdi mdi-sale"></i>
                <span class="hide-menu">{{trans('lang.coupon_plural')}}</span>
            </a>
        </li>


        <li class="nav-subtitle"><span class="nav-subtitle-span">{{trans('lang.setting_management')}}</span></li>

        <li>
            <a class="waves-effect waves-dark tax_menu" href="{!! url('tax') !!}" aria-expanded="false">

                <i class="mdi mdi-cash"></i>

                <span class="hide-menu">{{trans('lang.tax_plural')}}</span>

            </a>
        </li>


        <li>
            <a class="waves-effect waves-dark currency" href="{!! url('currency') !!}" aria-expanded="false">

                <i class="mdi mdi-currency-usd"></i>

                <span class="hide-menu">{{trans('lang.currencies')}}</span>

            </a>
        </li>
        <li>
            <a class="waves-effect waves-dark currency" href="{!! url('settings/languages') !!}" aria-expanded="false">

                <i class="mdi mdi-earth"></i>


                <span class="hide-menu">{{trans('lang.languages')}}</span>

            </a>
        </li>
        <li>
            <a class="waves-effect waves-dark currency" href="{!! url('settings/inquiry') !!}" aria-expanded="false">

                <i class="mdi mdi-contact-mail"></i>


                <span class="hide-menu">{{trans('lang.inquiry')}}</span>

            </a>
        </li>


        <li>
            <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                <i class="mdi mdi-bank"></i>
                <span class="hide-menu">{{trans('lang.payment_plural')}}</span>
            </a>
            <ul aria-expanded="false" class="collapse">
                <li><a href="{!! url('payoutRequest') !!}">{{trans('lang.payout_request')}}</a></li>
            </ul>
            <ul aria-expanded="false" class="collapse">
                <li><a href="{!! url('walletTransaction/user') !!}">{{trans('lang.users_wallet_transactions')}}</a></li>
            </ul>
        </li>

        <li>
            <a class="has-arrow waves-effect waves-dark setting_menu" href="#" aria-expanded="false">

                <i class="mdi mdi-settings"></i>

                <span class="hide-menu">{{trans('lang.app_setting')}}</span>

            </a>

            <ul aria-expanded="false" class="collapse setting_sub_menu">
                <li><a href="{!! url('settings/globals') !!}">{{trans('lang.app_setting_globals')}}</a></li>
                <li><a href="{!! url('settings/adminCommission') !!}">{{trans('lang.admin_commission')}}</a></li>
                <li><a href="{!! url('settings/payments/stripe') !!}"
                       class="setting_payment_menu">{{trans('lang.payment_methods')}}</a></li>
                <li><a href="{!! url('settings/landingPageTemplate') !!}">{{trans('lang.homepageTemplate')}}</a></li>
                <li><a href="{!! url('settings/headerTemplate') !!}">{{trans('lang.header_template')}}</a></li>
                <li><a href="{!! url('settings/footerTemplate') !!}">{{trans('lang.footer_template')}}</a></li>
                <li><a href="{!! url('settings/privacyPolicy') !!}">{{trans('lang.privacy_policy')}}</a></li>
                <li><a href="{!! url('settings/termsAndConditions') !!}">{{trans('lang.terms_and_conditions')}}</a></li>

            </ul>

        </li>


    </ul>

    <p class="web_version"></p>

</nav>
