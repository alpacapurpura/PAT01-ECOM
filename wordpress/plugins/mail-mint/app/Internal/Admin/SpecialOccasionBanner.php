<?php

namespace Mint\MRM\Internal\Admin;

use MRM\Common\MrmCommon;

/**
 * SpecialOccasionBanner Class
 *
 * This class is responsible for displaying a special occasion banner in the WordPress admin.
 *
 * @package YourVendor\SpecialOccasionPlugin
 */
class SpecialOccasionBanner
{

    /**
     * The occasion identifier.
     *
     * @var string
     */
    private $occasion;

    /**
     * The start date and time for displaying the banner.
     *
     * @var int
     */
    private $start_date;

    /**
     * The end date and time for displaying the banner.
     *
     * @var int
     */
    private $end_date;

    /**
     * Constructor method for SpecialOccasionBanner class.
     *
     * @param string $occasion   The occasion identifier.
     * @param string $start_date The start date and time for displaying the banner.
     * @param string $end_date   The end date and time for displaying the banner.
     */
    public function __construct($occasion, $start_date, $end_date)
    {
        $this->occasion = $occasion;
        $this->start_date = strtotime($start_date);
        $this->end_date = strtotime($end_date);

        // Hook into the admin_notices action to display the banner
        add_action('admin_notices', array($this, 'display_banner'));

        // Add styles
        add_action('admin_head', array($this, 'add_styles'));
    }

    /**
     * Calculate time remaining until Halloween
     *
     * @return array Time remaining in days, hours, and minutes
     */
    function mint_get_promotional_countdown()
    {
        $end_date  = strtotime('2025-10-20 23:59:59');
        $now       = current_time('timestamp');
        $diff      = $end_date - $now;

        return array(
            'days' => floor($diff / (60 * 60 * 24)),
            'hours' => floor(($diff % (60 * 60 * 24)) / (60 * 60)),
            'mins' => floor(($diff % (60 * 60)) / 60),
            'secs' => $diff % 60,
        );
    }


    /**
     * Displays the special occasion banner if the current date and time are within the specified range.
     */
    public function display_banner()
    {
        $screen = get_current_screen();
        $promotional_notice_pages = ['dashboard', 'plugins', 'toplevel_page_mrm-admin'];
        $current_date_time = current_time('timestamp');
        $btn_link = 'https://getwpfunnels.com/pricing/?utm_source=plugin&utm_medium=dashboard-banner-mm&utm_campaign=halloween25';

        if (!in_array($screen->id, $promotional_notice_pages)) {
            return;
        }

        if (defined('MAIL_MINT_PRO_VERSION') || ($current_date_time < $this->start_date || $current_date_time > $this->end_date) || 'no' === get_option('_is_show_halloween_banner') || MrmCommon::is_wpfnl_active()) {
            return;
        }

        // Calculate the time remaining in seconds
        $time_remaining = $this->end_date - $current_date_time;

        // Calculate the countdown
        $countdown = $this->mint_get_promotional_countdown();
        ?>

        <div class="gwpf-promotional-notice mailmint-promotional-notice <?php echo esc_attr($this->occasion); ?>-banner notice">
            <div class="gwpf-tb__notification">
                <div class="banner-overflow">
                    <section class="gwpf-promotional-banner" aria-labelledby="wpf-halloween-offer">
                        <div class="gwpf-container">
                            <div class="promotional-banner">
                                <div class="banner-content">
                                    <svg class="halloween-bird-left" width="29" height="12" fill="none" viewBox="0 0 29 12" xmlns="http://www.w3.org/2000/svg"><path fill="#fff" fill-opacity=".3" d="M27.902 1.572C26.192.363 24.57-.157 23.072.041c-2.263.292-3.61 2.136-4.259 3.021-.375.55-.807 1.075-1.292 1.567a10.355 10.355 0 01-.169-2.218l.037-1.041a.487.487 0 00-.127-.336.703.703 0 00-.35-.209.854.854 0 00-.435 0 .703.703 0 00-.35.209l-1.528 1.748a.716.716 0 01-.437.22.813.813 0 01-.504-.09l-2.17-1.23a.817.817 0 00-.417-.102.804.804 0 00-.41.119.57.57 0 00-.242.292.458.458 0 00.023.351l.467.969c.33.693.586 1.41.764 2.139A14.08 14.08 0 019.8 4.323c-1.265-.854-4.229-2.853-7.173-.97a7.149 7.149 0 00-2.01 2.023 10.66 10.66 0 00-.555.892.463.463 0 00-.056.314.52.52 0 00.166.288c.3.274.657.155 1.041.101a2.36 2.36 0 01.853.001c.28.052.542.155.767.3.312.233.559.517.725.833.166.316.248.657.24 1 .003.112.049.22.13.312a.7.7 0 00.327.199.854.854 0 00.408.016.738.738 0 00.35-.171 2.4 2.4 0 01.967-.617c.382-.136.802-.19 1.218-.158.896.164 1.379 1.03 1.627 1.729a.55.55 0 00.179.243c.085.068.19.117.304.142a.855.855 0 00.352.004.756.756 0 00.308-.136c.22-.2.493-.354.8-.45a2.55 2.55 0 01.967-.11c.544.118.845.646 1.001 1.067.032.086.09.164.167.229a.734.734 0 00.278.14.854.854 0 00.328.023.792.792 0 00.304-.102c.13-.094.284-.161.452-.198a1.41 1.41 0 01.514-.013c.122.03.235.08.33.148.096.067.173.15.225.244a.62.62 0 00.307.28c.139.064.3.087.457.067a.75.75 0 00.406-.184.504.504 0 00.17-.35.619.619 0 01.109-.29.79.79 0 01.248-.23 1.347 1.347 0 01.998-.063c.107.027.22.031.33.015a.782.782 0 00.3-.11.598.598 0 00.203-.209.466.466 0 00.06-.26c-.049-.23-.03-.465.057-.687.087-.222.238-.424.442-.59.297-.112.623-.166.951-.157.328.008.65.08.937.207a.846.846 0 00.678-.054.613.613 0 00.227-.216.468.468 0 00.067-.279c-.058-.724.035-1.67.81-2.07a2.946 2.946 0 012.383.138.837.837 0 00.779-.06.566.566 0 00.224-.275.456.456 0 00-.008-.33 2.012 2.012 0 01.144-1.988c.153-.198.359-.366.603-.491s.52-.204.807-.231c.378-.049.764-.039.927-.376.05-.1.062-.21.036-.316a.535.535 0 00-.184-.28c-.298-.242-.6-.473-.9-.685z"/></svg>

                                    <div class="banner-text">
                                        Get Ready To Sell More On <strong>Halloween!</strong> <svg width="18" height="18" fill="none" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg"><path fill="#fff" d="M17.637 7.522c-.942-2.907-3.153-3.501-4.812-3.501a7.861 7.861 0 00-2.231.327l-.144.041-.122-.082a2.657 2.657 0 00-.656-.286c.471-1.986 2.662-2.662 2.662-2.662L11.331.294s-.614.062-1.515.778c-.901.738-1.126 2.58-1.126 2.58s.02.123.082.307a2.062 2.062 0 00-.942.369l-.123.082-.143-.062c-.021 0-1.065-.368-2.375-.368-1.68 0-3.87.614-4.812 3.5-.798 2.417-.307 5.222 1.27 7.392 1.228 1.7 2.866 2.662 4.504 2.662.47 0 .942-.082 1.392-.246l.143-.061.123.082a2.297 2.297 0 002.519.04l.122-.081.144.04c.41.123.84.205 1.27.205.818 0 1.637-.245 2.395-.696.778-.45 1.474-1.126 2.088-1.965 1.576-2.15 2.068-4.955 1.29-7.33zm-3.522-.39c-1.29 4.137-3.808 1.618-3.808 1.618l3.808-1.617zM7.891 8.73s-2.518 2.518-3.808-1.618L7.89 8.73zm5.487 5.057l-.696-.737-2.314 1.515-1.371-1.126-1.352 1.126-2.334-1.515-.716.737-2.314-3.563L4.595 11.7l.716-.737 2.314 1.515 1.351-1.126 1.352 1.126 2.354-1.515.717.737 2.313-1.474-2.334 3.562z"/></svg>&nbsp;<span class="highlighted-text">25% OFF</span> on Mail Mint!
                                    </div>

                                    <a href="<?php echo esc_url($btn_link); ?>" class="cta-button" role="button" aria-label="get special discount " target="_blank">
                                        <?php
                                            echo __('Get 25% OFF', 'getwpfunnels');
                                        ?>
                                        <svg width="12" height="12" fill="none" viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg"><path fill="#02C4FB" stroke="#02C4FB" stroke-width=".5" d="M11 1.781v8.438a.781.781 0 11-1.563 0V3.667l-7.103 7.104a.781.781 0 01-1.105-1.105l7.104-7.104H1.78A.781.781 0 111.78 1h8.438a.781.781 0 01.78.781z"/></svg>
                                    </a>

                                    <svg class="halloween-bird-right" width="29" height="14" fill="none" viewBox="0 0 29 14" xmlns="http://www.w3.org/2000/svg"><path fill="#755FFD" d="M28.85 2.65a14.626 14.626 0 00-.9-.816C26.263.424 24.668-.177 23.209.045c-2.208.337-3.542 2.492-4.185 3.53a10.899 10.899 0 01-1.578 2.158 14.633 14.633 0 01-.237-3.028l.036-1.246a.481.481 0 00-.096-.298.523.523 0 00-.263-.186.55.55 0 00-.328 0 .523.523 0 00-.264.185l-1.548 2.087a.877.877 0 01-.558.334.906.906 0 01-.644-.134l-2.195-1.473a.543.543 0 00-.625.014.497.497 0 00-.183.26.475.475 0 00.017.314l.471 1.158a14.75 14.75 0 01.847 2.93 11.475 11.475 0 01-2.249-1.53C8.381 4.129 5.46 1.803 2.594 3.966A7.878 7.878 0 00.606 6.337c-.198.337-.386.692-.56 1.053a.476.476 0 00.085.535c.257.278.572.118.885.066.309-.065.629-.063.937.005.308.068.597.2.844.388.338.293.606.652.786 1.052.18.4.268.831.258 1.266.002.1.037.197.098.278a.523.523 0 00.246.177.55.55 0 00.571-.137c.276-.345.64-.616 1.058-.788a2.766 2.766 0 011.329-.191c.786.17 1.4.925 1.778 2.185a.494.494 0 00.136.217.55.55 0 00.728.008c.506-.454 1.284-.877 1.957-.707.506.13.89.598 1.138 1.39a.493.493 0 00.126.204.55.55 0 00.688.054 1.345 1.345 0 011.132-.278c.15.043.288.116.405.215.117.098.21.22.272.356a.515.515 0 00.232.25.555.555 0 00.345.059.53.53 0 00.306-.164.485.485 0 00.128-.311.986.986 0 01.131-.423c.076-.13.18-.243.307-.33a1.331 1.331 0 011.165-.1.551.551 0 00.475-.086.502.502 0 00.154-.186.476.476 0 00.046-.232c-.046-.827.147-1.39.58-1.673.572-.377 1.456-.226 2.094.04a.549.549 0 00.511-.048.506.506 0 00.172-.193.477.477 0 00.05-.248c-.089-1.307.224-2.215.904-2.626a2.761 2.761 0 012.593.16.546.546 0 00.587-.053.497.497 0 00.169-.246.475.475 0 00-.006-.293 2.906 2.906 0 01.164-2.517c.169-.257.395-.475.663-.638a2.2 2.2 0 01.887-.304c.314-.05.661-.004.804-.343a.477.477 0 00-.114-.53z"/></svg>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

                <button class="close-promotional-banner" type="button" aria-label="close banner">
                    <svg width="12" height="13" fill="none" viewBox="0 0 12 13" xmlns="http://www.w3.org/2000/svg"><path stroke="#7A8B9A" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 1.97L1 11.96m0-9.99l10 9.99"/></svg>
                </button>
            </div>
        </div>

        <script>
            var timeRemaining = <?php echo esc_js($time_remaining); ?>;

            function updateCountdown() {
                var endDate = new Date("2025-10-20 23:59:59").getTime();
                var now = new Date().getTime();
                var timeLeft = endDate - now;

                var days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
                var hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

                var daysElement = document.getElementById('mint-halloween-days');
                var hoursElement = document.getElementById('mint-halloween-hours');
                var minsElement = document.getElementById('mint-halloween-mins');
                var secsElement = document.getElementById('mint-halloween-secs');

                if (daysElement) {
                    daysElement.innerHTML = days;
                }

                if (hoursElement) {
                    hoursElement.innerHTML = hours;
                }

                if (minsElement) {
                    minsElement.innerHTML = minutes;
                }
                if (secsElement) {
                    secsElement.innerHTML = seconds;
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                updateCountdown();
                setInterval(updateCountdown, 1000); // Update every minute
            });
        </script>
    <?php
    }

    /**
     * Adds internal CSS styles for the special occasion banners.
     */
    public function add_styles()
    {
    ?>
        <style id="mailmint-promotional-banner-style">

            .mailmint-promotional-notice .gwpf-tb__notification,
            .mailmint-promotional-notice .gwpf-tb__notification * {
                box-sizing: border-box;
            }

            .mailmint-promotional-notice .gwpf-tb__notification {
                width: 100%;
                margin: 20px 0 20px;
                position: relative;
                border: none;
                box-shadow: none;
                display: block;
                max-height: 110px;
                border-radius: 6px;
            }
            .mailmint-promotional-notice .toplevel_page_mrm-admin .gwpf-tb__notification {
                width: calc(100% - 20px);
            }

            .mailmint-promotional-notice .gwpf-tb__notification .banner-overflow {
                position: relative;
                width: 100%;
                z-index: 1;
            }

            .gwpf-promotional-notice.notice {
                border: none;
                padding: 0;
                display: block;
                background: transparent;
                margin: 0;
                box-shadow: none !important;
            }

            .mailmint-promotional-notice .gwpf-tb__notification .close-promotional-banner {
                position: absolute;
                top: -10px;
                right: -9px;
                background: #fff;
                border: none;
                padding: 0;
                border-radius: 50%;
                cursor: pointer;
                z-index: 9;
                width: 30px;
                height: 30px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .mailmint-promotional-notice .gwpf-tb__notification .close-promotional-banner svg {
                width: 22px;
                display: block;
            }

            /* ---banner style start--- */
            .mailmint-promotional-notice .gwpf-promotional-banner {
                position: relative;
                background-color: #2d1568;
                background: linear-gradient(96deg, #573BFF 23.39%, #3216DA 49.94%);
                z-index: 1111;
                padding: 6px 0;
            }
            .mailmint-promotional-notice .gwpf-promotional-banner .promotional-banner {
                color: white;
                padding: 12px 20px;
                text-align: center;
                font-size: 14px;
                line-height: 1.4;
                position: relative;
            }
            .mailmint-promotional-notice .gwpf-promotional-banner .banner-content {
                max-width: 1200px;
                margin: 0 auto;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                flex-wrap: wrap;
                gap: 20px;
                row-gap: 8px;
                position: relative;
            }
            .mailmint-promotional-notice .gwpf-promotional-banner .banner-text {
                display: flex;
                align-items: center;
                flex-wrap: wrap;
                gap: 6px;
                row-gap: 0;
                justify-content: center;
                font-size: 16px;
                color: #fff;
                font-weight: 400;
                line-height: 1.4;
                text-transform: capitalize;
                letter-spacing: 0;
            }
            .mailmint-promotional-notice .gwpf-promotional-banner .banner-text svg {
                display: block;
            }
            .mailmint-promotional-notice .gwpf-promotional-banner .banner-text .highlighted-text {
                color: #02C4FB;
                font-weight: 700;
            }
            .mailmint-promotional-notice .gwpf-promotional-banner .halloween-bird-left {
                position: absolute;
                left: -47px;
                bottom: -7px;
            }
            .mailmint-promotional-notice .gwpf-promotional-banner .halloween-bird-right {
                position: absolute;
                right: -50px;
                top: -5px;
            }
            .mailmint-promotional-notice .gwpf-promotional-banner .cta-button {
                color: #02C4FB;
                font-size: 16px;
                font-style: normal;
                font-weight: 700;
                line-height: normal;
                text-decoration: underline;
                text-decoration-thickness: 2px;
                text-underline-offset: 5px;
                display: inline-flex;
                align-items: center;
                gap: 5px;
                transition: all 0.2s ease;
            }
            .mailmint-promotional-notice .gwpf-promotional-banner .cta-button:focus, 
            .mailmint-promotional-notice .gwpf-promotional-banner .cta-button:visited {
                color: #02C4FB !important;
            }
            .mailmint-promotional-notice .gwpf-promotional-banner .cta-button:hover {
                color: #fff !important;
            }
            .mailmint-promotional-notice .gwpf-promotional-banner .cta-button:hover svg path {
                stroke: #fff;
                fill: #fff;
            }

            .mailmint-promotional-notice .gwpf-tb__notification .close-promotional-banner {
                position: absolute;
                top: -10px;
                right: -9px;
                background: #fff;
                border: none;
                padding: 0;
                border-radius: 50%;
                cursor: pointer;
                z-index: 9;
                width: 30px;
                height: 30px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .mailmint-promotional-notice .gwpf-tb__notification .close-promotional-banner svg {
                width: 22px;
                display: block;
            }

            @media only screen and (max-width: 991px) {
                .mailmint-promotional-notice .promotional-banner {
                    padding: 16px 20px;
                }

                .mailmint-promotional-notice .gwpf-tb__notification {
                    margin: 60px 0 20px;
                }

                .mailmint-promotional-notice .gwpf-tb__notification .close-promotional-banner {
                    width: 25px;
                    height: 25px;
                }
            }

            @media only screen and (max-width: 767px) {
                .mailmint-promotional-notice .wpvr-promotional-banner {
                    padding-top: 20px;
                    padding-bottom: 30px;
                    max-height: none;
                }

                .mailmint-promotional-notice .wpvr-promotional-banner {
                    max-height: none;
                }
            }

            @media only screen and (max-width: 575px) {
                .mailmint-promotional-notice .promotional-banner {
                    padding: 16px 55px;
                    font-size: 13px;
                }
                .mailmint-promotional-notice .gwpf-promotional-banner .halloween-bird-left {
                    left: -12px;
                    bottom: inherit;
                    top: -5px;
                }
                .mailmint-promotional-notice .gwpf-promotional-banner .halloween-bird-right {
                    right: -12px;
                    bottom: -7px;
                    top: inherit;
                }
            }
        </style>

<?php
    }
}
