<?php
global $farallonSetting;
if ($farallonSetting->get_setting('rss')) : ?>
    <a href="<?php echo get_feed_link() ?>" target="_blank">
        <svg class="sns" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 17C12 14 10 12 7 12" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M17 17C17 11 13 7 7 7" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M7 17.01L7.01 16.9989" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M21 8V16C21 18.7614 18.7614 21 16 21H8C5.23858 21 3 18.7614 3 16V8C3 5.23858 5.23858 3 8 3H16C18.7614 3 21 5.23858 21 8Z" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    </a>
<?php endif; ?>
<?php if ($farallonSetting->get_setting('email')) : ?>
    <a href="mailto:<?php echo $farallonSetting->get_setting('email'); ?>" target="_blank">
        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" xml:space="preserve">
            <path class="st0" d="M510.678,112.275c-2.308-11.626-7.463-22.265-14.662-31.054c-1.518-1.915-3.104-3.63-4.823-5.345
		c-12.755-12.818-30.657-20.814-50.214-20.814H71.021c-19.557,0-37.395,7.996-50.21,20.814c-1.715,1.715-3.301,3.43-4.823,5.345
		C8.785,90.009,3.63,100.649,1.386,112.275C0.464,116.762,0,121.399,0,126.087V385.92c0,9.968,2.114,19.55,5.884,28.203
		c3.497,8.26,8.653,15.734,14.926,22.001c1.59,1.586,3.169,3.044,4.892,4.494c12.286,10.175,28.145,16.32,45.319,16.32h369.958
		c17.18,0,33.108-6.145,45.323-16.384c1.718-1.386,3.305-2.844,4.891-4.43c6.27-6.267,11.425-13.741,14.994-22.001v-0.064
		c3.769-8.653,5.812-18.171,5.812-28.138V126.087C512,121.399,511.543,116.762,510.678,112.275z M46.509,101.571
		c6.345-6.338,14.866-10.175,24.512-10.175h369.958c9.646,0,18.242,3.837,24.512,10.175c1.122,1.129,2.179,2.387,3.112,3.637
		L274.696,274.203c-5.348,4.687-11.954,7.002-18.696,7.002c-6.674,0-13.276-2.315-18.695-7.002L43.472,105.136
		C44.33,103.886,45.387,102.7,46.509,101.571z M36.334,385.92V142.735L176.658,265.15L36.405,387.435
		C36.334,386.971,36.334,386.449,36.334,385.92z M440.979,420.597H71.021c-6.281,0-12.158-1.651-17.174-4.552l147.978-128.959
		l13.815,12.018c11.561,10.046,26.028,15.134,40.36,15.134c14.406,0,28.872-5.088,40.432-15.134l13.808-12.018l147.92,128.959
		C453.137,418.946,447.26,420.597,440.979,420.597z M475.666,385.92c0,0.529,0,1.051-0.068,1.515L335.346,265.221L475.666,142.8
		V385.92z" />
        </svg>
    </a>
<?php endif; ?>
<?php if ($farallonSetting->get_setting('telegram')) : ?>
    <a href="<?php echo $farallonSetting->get_setting('telegram'); ?>" target="_blank">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="30px" height="30px">
            <path d="M 25.154297 3.984375 C 24.829241 3.998716 24.526384 4.0933979 24.259766 4.2011719 C 24.010014 4.3016357 23.055766 4.7109106 21.552734 5.3554688 C 20.048394 6.0005882 18.056479 6.855779 15.931641 7.7695312 C 11.681964 9.5970359 6.9042108 11.654169 4.4570312 12.707031 C 4.3650097 12.746607 4.0439208 12.849183 3.703125 13.115234 C 3.3623292 13.381286 3 13.932585 3 14.546875 C 3 15.042215 3.2360676 15.534319 3.5332031 15.828125 C 3.8303386 16.121931 4.144747 16.267067 4.4140625 16.376953 C 5.3912284 16.775666 8.4218473 18.015862 8.9941406 18.25 C 9.195546 18.866983 10.29249 22.222526 10.546875 23.044922 C 10.714568 23.587626 10.874198 23.927519 11.082031 24.197266 C 11.185948 24.332139 11.306743 24.45034 11.453125 24.542969 C 11.511635 24.579989 11.575789 24.608506 11.640625 24.634766 L 11.644531 24.636719 C 11.659471 24.642719 11.67235 24.652903 11.6875 24.658203 C 11.716082 24.668202 11.735202 24.669403 11.773438 24.677734 C 11.925762 24.726927 12.079549 24.757812 12.216797 24.757812 C 12.80196 24.757814 13.160156 24.435547 13.160156 24.435547 L 13.181641 24.419922 L 16.191406 21.816406 L 19.841797 25.269531 C 19.893193 25.342209 20.372542 26 21.429688 26 C 22.057386 26 22.555319 25.685026 22.875 25.349609 C 23.194681 25.014192 23.393848 24.661807 23.478516 24.21875 L 23.478516 24.216797 C 23.557706 23.798129 26.921875 6.5273437 26.921875 6.5273438 L 26.916016 6.5507812 C 27.014496 6.1012683 27.040303 5.6826405 26.931641 5.2695312 C 26.822973 4.8564222 26.536648 4.4608905 26.181641 4.2480469 C 25.826669 4.0352506 25.479353 3.9700339 25.154297 3.984375 z M 24.966797 6.0742188 C 24.961997 6.1034038 24.970391 6.0887279 24.962891 6.1230469 L 24.960938 6.1347656 L 24.958984 6.1464844 C 24.958984 6.1464844 21.636486 23.196371 21.513672 23.845703 C 21.522658 23.796665 21.481573 23.894167 21.439453 23.953125 C 21.379901 23.91208 21.257812 23.859375 21.257812 23.859375 L 21.238281 23.837891 L 16.251953 19.121094 L 12.726562 22.167969 L 13.775391 17.96875 C 13.775391 17.96875 20.331562 11.182109 20.726562 10.787109 C 21.044563 10.471109 21.111328 10.360953 21.111328 10.251953 C 21.111328 10.105953 21.035234 10 20.865234 10 C 20.712234 10 20.506484 10.14875 20.396484 10.21875 C 18.963383 11.132295 12.671823 14.799141 9.8515625 16.439453 C 9.4033769 16.256034 6.2896636 14.981472 5.234375 14.550781 C 5.242365 14.547281 5.2397349 14.548522 5.2480469 14.544922 C 7.6958673 13.491784 12.47163 11.434667 16.720703 9.6074219 C 18.84524 8.6937992 20.838669 7.8379587 22.341797 7.1933594 C 23.821781 6.5586849 24.850125 6.1218894 24.966797 6.0742188 z" />
        </svg>
    </a>
<?php endif; ?>
<?php
if ($farallonSetting->get_setting('twitter')) :
?>
    <a href="<?php echo $farallonSetting->get_setting('twitter'); ?>" target="_blank">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="30px" height="30px">
            <path d="M26.37,26l-8.795-12.822l0.015,0.012L25.52,4h-2.65l-6.46,7.48L11.28,4H4.33l8.211,11.971L12.54,15.97L3.88,26h2.65 l7.182-8.322L19.42,26H26.37z M10.23,6l12.34,18h-2.1L8.12,6H10.23z" />
        </svg>
    </a>
<?php endif; ?>
<?php if ($farallonSetting->get_setting('instagram')) : ?>
    <a href="<?php echo $farallonSetting->get_setting('instagram'); ?>" target="_blank">
        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M10.825091,2 L13.1738932,2 C14.8491598,2.00379146 15.2338099,2.01854561 16.1226982,2.059103 C17.187141,2.10765278 17.9141174,2.27672349 18.5502266,2.52395815 C19.2078518,2.77948955 19.7655588,3.12144192 20.3215589,3.67740233 C20.8775194,4.23340244 21.2194717,4.79110953 21.4750428,5.44873467 C21.7222377,6.08484389 21.8913085,6.81182019 21.9398582,7.87626307 C21.9869049,8.90737346 21.9992305,9.25998097 22,11.7357029 L22,12.2632942 C21.9992305,14.7389803 21.9869049,15.0915878 21.9398582,16.1226982 C21.8913085,17.187141 21.7222377,17.9141174 21.4750428,18.5502266 C21.2194717,19.2078518 20.8775194,19.7655588 20.3215589,20.3215589 C19.7655588,20.8775194 19.2078518,21.2194717 18.5502266,21.4750428 C17.9141174,21.7222377 17.187141,21.8913085 16.1226982,21.9398582 C15.0915878,21.9869049 14.7389803,21.9992305 12.2632942,22 L11.7357029,22 C9.25998097,21.9992305 8.90737346,21.9869049 7.87626307,21.9398582 C6.81182019,21.8913085 6.08484389,21.7222377 5.44873467,21.4750428 C4.79110953,21.2194717 4.23340244,20.8775194 3.67740233,20.3215589 C3.12144192,19.7655588 2.77948955,19.2078518 2.52395815,18.5502266 C2.27672349,17.9141174 2.10765278,17.187141 2.059103,16.1226982 C2.01854561,15.2338099 2.00379146,14.8491598 2,13.1738932 L2,10.825091 C2.00379146,9.14980144 2.01854561,8.76515134 2.059103,7.87626307 C2.10765278,6.81182019 2.27672349,6.08484389 2.52395815,5.44873467 C2.77948955,4.79110953 3.12144192,4.23340244 3.67740233,3.67740233 C4.23340244,3.12144192 4.79110953,2.77948955 5.44873467,2.52395815 C6.08484389,2.27672349 6.81182019,2.10765278 7.87626307,2.059103 C8.76515134,2.01854561 9.14980144,2.00379146 10.825091,2 L13.1738932,2 L10.825091,2 Z M12.733046,3.80115495 L11.2659442,3.80115495 C9.25857953,3.80324073 8.90746344,3.81583469 7.95839674,3.85913648 C6.98335214,3.90359743 6.45383012,4.06651507 6.10143736,4.20347069 C5.63463704,4.38488726 5.30149746,4.60159471 4.95156594,4.95156594 C4.60159471,5.30149746 4.38488726,5.63463704 4.20347069,6.10143736 C4.06651507,6.45383012 3.90359743,6.98335214 3.85913648,7.95839674 C3.81583469,8.90746344 3.80324073,9.25857953 3.80115495,11.2659442 L3.80115495,12.733046 C3.80324073,14.7403818 3.81583469,15.0914978 3.85913648,16.0405646 C3.90359743,17.0156091 4.06651507,17.5451311 4.20347069,17.8975239 C4.38488726,18.3643242 4.60163441,18.6974638 4.95156594,19.0473953 C5.30149746,19.3973665 5.63463704,19.614074 6.10143736,19.7954906 C6.45383012,19.9324462 6.98335214,20.0953638 7.95839674,20.1398247 C9.0127962,20.1879378 9.32902474,20.1981401 11.9995005,20.1981401 C14.6699365,20.1981401 14.9862047,20.1879378 16.0405646,20.1398247 C17.0156091,20.0953638 17.5451311,19.9324462 17.8975239,19.7954906 C18.3643242,19.614074 18.6974638,19.3973665 19.0473953,19.0473953 C19.3973665,18.6974638 19.614074,18.3643242 19.7954906,17.8975239 C19.9324462,17.5451311 20.0953638,17.0156091 20.1398247,16.0405646 C20.1879378,14.986046 20.1981401,14.6697381 20.1981401,11.9995005 C20.1981401,9.32922322 20.1879378,9.0129153 20.1398247,7.95839674 C20.0953638,6.98335214 19.9324462,6.45383012 19.7954906,6.10143736 C19.614074,5.63463704 19.3973665,5.30149746 19.0473953,4.95156594 C18.6974638,4.60159471 18.3643242,4.38488726 17.8975239,4.20347069 C17.5451311,4.06651507 17.0156091,3.90359743 16.0405646,3.85913648 C15.0914978,3.81583469 14.7403818,3.80324073 12.733046,3.80115495 Z M11.9995,6.99920128 C14.7610764,6.99920128 16.99976,9.23788484 16.99976,11.9995 C16.99976,14.7610764 14.7610764,16.99976 11.9995,16.99976 C9.23788484,16.99976 6.99920128,14.7610764 6.99920128,11.9995 C6.99920128,9.23788484 9.23788484,6.99920128 11.9995,6.99920128 Z M11.9995,8.75368323 C10.2068679,8.75368323 8.75368323,10.2068679 8.75368323,11.9995 C8.75368323,13.7920934 10.2068679,15.245278 11.9995,15.245278 C13.7920934,15.245278 15.245278,13.7920934 15.245278,11.9995 C15.245278,10.2068679 13.7920934,8.75368323 11.9995,8.75368323 Z M17.4164293,5.33244149 C18.1068302,5.33244149 18.6665198,5.89213105 18.6665198,6.58253201 C18.6665198,7.27293296 18.1068302,7.83258117 17.4164293,7.83258117 C16.7260697,7.83258117 16.1663801,7.27293296 16.1663801,6.58253201 C16.1663801,5.89213105 16.7260697,5.33244149 17.4164293,5.33244149 Z" />
        </svg>
    </a>
<?php endif; ?>
<?php if ($farallonSetting->get_setting('github')) : ?>
    <a href="<?php echo $farallonSetting->get_setting('github'); ?>" target="_blank">
        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M20.9992 5.95846C21.0087 6.565 20.9333 7.32649 20.8658 7.8807C20.8395 8.09686 20.8037 8.27676 20.7653 8.42453C21.6227 10.01 22 11.9174 22 14C22 16.4684 20.8127 18.501 18.9638 19.8871C17.1319 21.2605 14.6606 22 12 22C9.33939 22 6.86809 21.2605 5.0362 19.8871C3.18727 18.501 2 16.4684 2 14C2 11.9174 2.37732 10.01 3.23472 8.42452C3.19631 8.27676 3.16055 8.09685 3.13422 7.8807C3.06673 7.32649 2.99133 6.565 3.00081 5.95846C3.01149 5.27506 3.10082 4.5917 3.19988 3.91379C3.24569 3.60028 3.31843 3.30547 3.65883 3.11917C4.00655 2.92886 4.37274 2.99981 4.73398 3.1021C5.95247 3.44713 7.09487 3.93108 8.16803 4.51287C9.2995 4.17287 10.5783 4 12 4C13.4217 4 14.7005 4.17287 15.832 4.51287C16.9051 3.93108 18.0475 3.44713 19.266 3.1021C19.6273 2.99981 19.9935 2.92886 20.3412 3.11917C20.6816 3.30547 20.7543 3.60028 20.8001 3.91379C20.8992 4.5917 20.9885 5.27506 20.9992 5.95846ZM20 14C20 12.3128 19.6122 10 17.5 10C16.5478 10 15.6474 10.2502 14.7474 10.5004C13.8482 10.7502 12.9495 11 12 11C11.0505 11 10.1518 10.7502 9.25263 10.5004C8.35261 10.2502 7.45216 10 6.5 10C4.39379 10 4 12.3197 4 14C4 15.7636 4.82745 17.231 6.23588 18.2869C7.66135 19.3556 9.69005 20 12 20C14.3099 20 16.3386 19.3555 17.7641 18.2869C19.1726 17.231 20 15.7636 20 14ZM10 14.5C10 15.8807 9.32843 17 8.5 17C7.67157 17 7 15.8807 7 14.5C7 13.1193 7.67157 12 8.5 12C9.32843 12 10 13.1193 10 14.5ZM15.5 17C16.3284 17 17 15.8807 17 14.5C17 13.1193 16.3284 12 15.5 12C14.6716 12 14 13.1193 14 14.5C14 15.8807 14.6716 17 15.5 17Z" />
        </svg>
    </a>
<?php endif; ?>
<?php if ($farallonSetting->get_setting('discord')) : ?>
    <a href="<?php echo $farallonSetting->get_setting('discord'); ?>" target="_blank">
        <svg viewBox="0 0 24 24" role="img" xmlns="http://www.w3.org/2000/svg">
            <path d="M20.317 4.37a19.791 19.791 0 0 0-4.885-1.515.074.074 0 0 0-.079.037c-.21.375-.444.864-.608 1.25a18.27 18.27 0 0 0-5.487 0 12.64 12.64 0 0 0-.617-1.25.077.077 0 0 0-.079-.037A19.736 19.736 0 0 0 3.677 4.37a.07.07 0 0 0-.032.027C.533 9.046-.32 13.58.099 18.057a.082.082 0 0 0 .031.057 19.9 19.9 0 0 0 5.993 3.03.078.078 0 0 0 .084-.028 14.09 14.09 0 0 0 1.226-1.994.076.076 0 0 0-.041-.106 13.107 13.107 0 0 1-1.872-.892.077.077 0 0 1-.008-.128 10.2 10.2 0 0 0 .372-.292.074.074 0 0 1 .077-.01c3.928 1.793 8.18 1.793 12.062 0a.074.074 0 0 1 .078.01c.12.098.246.198.373.292a.077.077 0 0 1-.006.127 12.299 12.299 0 0 1-1.873.892.077.077 0 0 0-.041.107c.36.698.772 1.362 1.225 1.993a.076.076 0 0 0 .084.028 19.839 19.839 0 0 0 6.002-3.03.077.077 0 0 0 .032-.054c.5-5.177-.838-9.674-3.549-13.66a.061.061 0 0 0-.031-.03zM8.02 15.33c-1.183 0-2.157-1.085-2.157-2.419 0-1.333.956-2.419 2.157-2.419 1.21 0 2.176 1.096 2.157 2.42 0 1.333-.956 2.418-2.157 2.418zm7.975 0c-1.183 0-2.157-1.085-2.157-2.419 0-1.333.955-2.419 2.157-2.419 1.21 0 2.176 1.096 2.157 2.42 0 1.333-.946 2.418-2.157 2.418z" />
        </svg>
    </a>
<?php endif; ?>
<?php if ($farallonSetting->get_setting('mastodon')) : ?>
    <a href="<?php echo $farallonSetting->get_setting('mastodon'); ?>" target="_blank">
        <svg width="800px" height="800px" viewBox="0 0 192 192" xmlns="http://www.w3.org/2000/svg" xml:space="preserve" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2">
            <path d="M2004.3 228h-.57c-19.87.163-38.97 2.491-50.13 7.601-.5.213-24.58 10.78-24.58 46.99 0 7.394-.14 16.236.09 25.612.4 16.438 2 32.742 7.21 45.957 5.67 14.406 15.47 25.335 32.04 29.72 14.11 3.737 26.23 4.503 35.99 3.967h.01c18.41-1.021 28.71-6.695 28.71-6.695a6.018 6.018 0 0 0 3.16-5.558l-.56-12.178a5.984 5.984 0 0 0-2.56-4.646 5.995 5.995 0 0 0-5.24-.804s-11.04 3.471-23.45 3.047c-4.87-.167-9.84-.357-14.18-1.544-3.91-1.069-7.14-3.148-8.76-7.347 5.59.951 13.45 2.021 22.27 2.425 10.49.481 20.33-.592 30.33-1.785 12.37-1.477 23.76-6.688 31.4-13.091 5.8-4.865 9.47-10.509 10.5-15.801v-.001c3.23-16.623 3.05-40.428 3.04-41.319-.01-36.286-24.23-46.801-24.58-46.951-11.14-5.105-30.25-7.436-50.14-7.599Zm59.9 93.58.09-.471c3.1-15.948 2.73-38.451 2.73-38.451v-.067c0-27.633-17.49-36.04-17.49-36.04a.234.234 0 0 0-.05-.024c-10.05-4.616-27.33-6.379-45.26-6.527h-.41c-17.93.148-35.2 1.911-45.25 6.527l-.06.024s-17.48 8.407-17.48 36.04c0 7.308-.15 16.047.09 25.314v.004c.36 14.96 1.64 29.826 6.37 41.852 4.27 10.836 11.49 19.221 23.95 22.519 12.65 3.349 23.51 4.066 32.26 3.585 9.61-.533 16.56-2.512 20.36-3.891l-.04-.739c-5.11 1.018-12.33 2.033-20 1.771-16.29-.559-32.69-3.029-35.34-23.016a40.2 40.2 0 0 1-.35-5.4 6 6 0 0 1 2.3-4.719 5.998 5.998 0 0 1 5.13-1.109s12.59 3.066 28.55 3.798c9.81.45 19.01-.598 28.36-1.713 9.88-1.18 19.01-5.258 25.11-10.372 3.36-2.814 5.83-5.834 6.43-8.895Zm-54.2-36.244c.68-2.603 3.99-12.807 14.27-12.807 10.68 0 10.54 12.137 10.54 12.137v34.224c0 3.311 2.69 6 6 6s6-2.689 6-6v-34.406s-.68-23.955-22.54-23.955c-10 0-16.43 5.292-20.4 10.778-4.07-5.273-10.62-10.293-20.78-10.293-6.92 0-11.53 2.138-14.68 4.857-6.67 5.747-6.86 14.826-6.81 16.949l.02.455s-.01-.161-.02-.455v-.052 36.342c0 3.311 2.69 6 6 6s6-2.689 6-6v-36.342c0-.169-.01-.338-.02-.507 0 0-.5-4.577 2.66-7.298 1.45-1.252 3.66-1.949 6.85-1.949 10.65 0 14.18 9.844 14.91 12.386v20.233c0 3.311 2.69 6 6 6s6-2.689 6-6v-20.297Z" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2" transform="translate(-1908 -212)" />
        </svg>
    </a>
<?php endif; ?>
<?php if ($farallonSetting->get_setting('custom_sns')) echo $farallonSetting->get_setting('custom_sns'); ?>