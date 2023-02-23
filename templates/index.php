<div class="wrap">
    <h1>
        اتصال افزونه وردپرس به پلتفرم سامری
    </h1>
    <?php /*settings_errors();*/ ?>
    <ul class="nav nav-tab">
        <li class="active"><a href="#tab-1">دسترسی به سرور</a></li>
        <li><a href="#tab-2">تنظیمات پیشرفته</a></li>
        <li><a href="#tab-3">درباره ما</a></li>
    </ul>
    <div class="x-content">
        <div id="tab-1" class="tab-pane active">
            <form method="post" action="options.php">
                <?php 
                    settings_fields( 'wp-splus-server-group' );
                    do_settings_sections( 'wp-splus-server' );
                    submit_button();
                ?>
            </form>
        </div>
        <div id="tab-2" class="tab-pane">
            <form method="post" action="options.php">
               <?php 
                    settings_fields( 'wp-splus-settings-group' );
                    do_settings_sections( 'wp-splus-settings' );
                    submit_button();
                ?>
            </form>
        </div>
        <div id="tab-3" class="tab-pane">
            <form method="post" action="options.php">
                <br/>
               <p>
                    از طریق وب سایت رسمی شرکت(<a target="_blank" href="https://www.crm-support.ir">CRM-Support</a>) و یا با شماره گیری ۹۱۰۹۴۵۹۵-۰۲۱ داخلی ۱ در ارتباط باشید.
               </p>
            </form>
        </div>
    </div>
</div>