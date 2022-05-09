<?php
/**
 * @package     Mautic
 * @copyright   2020 Enguerr. All rights reserved
 * @author      Enguerr
 * @link        https://www.enguer.com
 * @license     GNU/AGPLv3 http://www.gnu.org/licenses/agpl.html
 */

header("Access-Control-Allow-Origin: *");
$codeMode   = 'mautic_code_mode';
$isCodeMode = ($active == $codeMode);
?>
<style>
    .bf-item {
        position: relative;
        width: 100%;
        height: 300px;
        background-color: #fff;
        overflow: hidden;
    }
    .bf-item:after {
        content: '';
        display: block;
        background-color: #fcfcfc;
        opacity: 0.9;
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        -webkit-transform: scale(2) translateX(-75%) translateY(-75%) translateZ(0) rotate(-28deg);
        transform: scale(2) translateX(-75%) translateY(-75%) translateZ(0) rotate(-28deg);
        -webkit-transition: -webkit-transform 3s cubic-bezier(0.23, 1, 0.32, 1);
        transition: -webkit-transform 3s cubic-bezier(0.23, 1, 0.32, 1);
        transition: transform 3s cubic-bezier(0.23, 1, 0.32, 1);
        transition: transform 3s cubic-bezier(0.23, 1, 0.32, 1), -webkit-transform 3s cubic-bezier(0.23, 1, 0.32, 1);
    }
    .bf-item:hover:after {
        -webkit-transform: scale(2) translateX(0%) translateY(0%) translateZ(0) rotate(-28deg);
        transform: scale(2) translateX(0%) translateY(0%) translateZ(0) rotate(-28deg);
    }
    .bf-item:hover .bf-item-image {
        -webkit-transform: scale(1.2) translateZ(0);
        transform: scale(1.2) translateZ(0);
    }
    .bf-item:hover .bf-item-text {
        opacity: 1;
        -webkit-transform: translateY(0);
        transform: translateY(0);
    }

    .bf-item-image {
        height: auto;
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
        -webkit-transform: translateZ(0);
        transform: translateZ(0);
        -webkit-transition: -webkit-transform 750ms cubic-bezier(0.23, 1, 0.32, 1);
        transition: -webkit-transform 750ms cubic-bezier(0.23, 1, 0.32, 1);
        transition: transform 750ms cubic-bezier(0.23, 1, 0.32, 1);
        transition: transform 750ms cubic-bezier(0.23, 1, 0.32, 1), -webkit-transform 750ms cubic-bezier(0.23, 1, 0.32, 1);
    }
    .bf-item-image::before {
        content: "";
        display: block;
        padding-top: 75%;
        overflow: hidden;
    }
    .bf-item-image img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: auto;
        line-height: 0;
    }

    .bf-item-image iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 400%;
        height: 700%;
        line-height: 0;

        -ms-zoom: 0.25;
        -moz-transform: scale(0.25);
        -moz-transform-origin: 0 0;
        -o-transform: scale(0.25);
        -o-transform-origin: 0 0;
        -webkit-transform: scale(0.25);
        -webkit-transform-origin: 0 0;
    }

    .bf-item-text {
        position: absolute;
        top: 0;
        right: 0;
        left: 0;
        bottom: 0;
        opacity: 0;
        text-align: center;
        z-index: 1;
        color: #666;
        -webkit-transition: opacity 500ms cubic-bezier(0.23, 1, 0.32, 1), -webkit-transform 500ms cubic-bezier(0.23, 1, 0.32, 1);
        transition: opacity 500ms cubic-bezier(0.23, 1, 0.32, 1), -webkit-transform 500ms cubic-bezier(0.23, 1, 0.32, 1);
        transition: opacity 500ms cubic-bezier(0.23, 1, 0.32, 1), transform 500ms cubic-bezier(0.23, 1, 0.32, 1);
        transition: opacity 500ms cubic-bezier(0.23, 1, 0.32, 1), transform 500ms cubic-bezier(0.23, 1, 0.32, 1), -webkit-transform 500ms cubic-bezier(0.23, 1, 0.32, 1);
        -webkit-transition-delay: 300ms;
        transition-delay: 300ms;
        -webkit-transform: translateY(-20%);
        transform: translateY(-20%);
    }

    .bf-item-text-wrapper {
        width: 100%;
        position: absolute;
        top: 50%;
        -webkit-transform: translateY(-50%);
        transform: translateY(-50%);
    }

    .bf-item-text-title {
        font-weight: normal;
        font-style: 16px;
        padding: 0 15px;
        margin: 5px 0 0 0;
    }

    .bf-item-text-dek {
        text-transform: uppercase;
        font-style: 14px;
        opacity: 0.7;
        margin: 0;
    }

    .bf-item-link {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        z-index: 2;
        line-height: 0;
        overflow: hidden;
        text-indent: -9999px;
    }
    .fb-icon {
        color: #ccc;
        position: absolute;
        top: 100px;
        left: calc( 50% - 40px );
        font-size: 8em;
    }
</style>
<div class="row">
    <?php if ($version) : ?>
    <div class="col-md-3 beefree-theme-list">
        <div class="panel panel-default">
            <div class="panel-body text-center">
                <div class="bf-item">
                    <div class="bf-item-image">
                        <i class="fa fa-edit text-muted fb-icon" aria-hidden="true" ></i>
                    </div>
                    <div class="bf-item-text">
                        <div class="bf-item-text-wrapper">
<!--                            <p class="bf-item-text-dek">--><?php //echo $version->getName(); ?><!--</p>-->
                            <h2 class="bf-item-text-title"><?php echo $view['translator']->trans('mautic.beefree.current.title'); ?></h2>
                            <a href="#" type="button" data-theme-beefree="current" class="btn btn-default bf-item-text-title" style="margin: 50px auto;background-color: rgba(255,255,255,0.8);padding: 20px;">
                                <?php echo $view['translator']->trans('mautic.beefree.current'); ?>
                            </a>
                        </div>
                    </div>
                    <a href="#" type="button" data-theme-beefree="current" class="bf-item-link select-theme-link btn-dnd btn-nospin text-success btn-builder btn-copy " onclick="Mautic.launchCustomBuilder('emailform', 'email',this);">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <div class="col-md-3 beefree-theme-list">
        <div class="panel panel-default ">
            <div class="panel-body text-center">
                <div class="bf-item">
                    <div class="bf-item-image">
                        <i class="fa fa-file text-muted fb-icon" aria-hidden="true" ></i>
                    </div>
                    <div class="bf-item-text">
                        <div class="bf-item-text-wrapper">
                            <p class="bf-item-text-dek">empty-model</p>
                            <h2 class="bf-item-text-title"><?php echo $view['translator']->trans('mautic.beefree.from-scratch'); ?></h2>
                            <a href="#" type="button" data-theme-beefree="new" class="btn btn-default bf-item-text-title" style="margin: 50px auto;background-color: rgba(255,255,255,0.5);padding: 20px;">
                                <?php echo $view['translator']->trans('mautic.beefree.from-scratch'); ?>
                            </a>
                        </div>
                    </div>
                    <a href="#" type="button" data-theme-beefree="new" class="bf-item-link select-theme-link btn-dnd btn-nospin text-success btn-builder btn-copy " onclick="Mautic.launchCustomBuilder('emailform', 'email',this);">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php if ($bfthemes) : ?>
        <?php foreach ($bfthemes as $themeInfo) : ?>

            <?php
                $themeKey = $themeInfo->getName();
                $isSelected = ($active === $themeKey);
            ?>

            <?php $thumbnailUrl = '';//$view['assets']->getUrl($themeInfo['themesLocalDir'].'/'.$themeKey.'/'.$thumbnailName); ?>
            <div class="col-md-3 beefree-theme-list">

                <div class="panel panel-default <?php echo $isSelected ? 'beefree-selected' : ''; ?>">

                    <div class="panel-body text-center">

                        <div class="bf-item">
                            <div class="bf-item-image">
                                <?php
                                $data = $themeInfo->getPreview();

                                // if base64 encoded
                                if (strpos($data, '/') === 0)
                                {
                                    echo '<img src="data:image/jpeg;base64,'.$data.'" alt="" />';
                                }

                                // if html
                                elseif (strpos($data, '<!D') === 0)
                                {
                                    // html code
//                                    echo $data;

                                    // default image
//                                    echo '<img src="data:image/jpeg;base64,'.'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CdQamv6qvHVV46qvHVV46qvHVV46qvHVV46qvHVV46qvHVV46qvHVV46qvHVV46qvHVV46qvHVV46qvHVV46qvBT04l1a5PS+6laVpwkujEN23hmDlWl374e5VrXhJdGIbtvC5G1OcLLa33NrUmQkcksckscksckscksckscksckscksckscksckscksckscksckscksckscksckscksckscksckscksckscksOTUmXEX21subDakuHCS6MQ3beFR7CP2/2rPbT+xwkujEN23hUewj9v9qz20/scJLoxDdt4VHsI/b/as9tP7HCS6MQ3bdyl1Qpq5C2DIWwHVpccmupYoyFsGQtgyFsGQtgyFsGQtgyFsGQtgyFsGQtgyFsGQtgyFsGQtgyFsGQtgyFsGQtgyFsGQtgyFsGQtgyFsFJA2VqnUkqbexZ7af2OEl0Yhu27L77S7Ht9NWX/ALSTTCDI69/f7Fntp/Y4SXRiG7bsmaypaYNzeocDMVWjFFoxRaMUWjFFoxRaMUWjFFoxRaMUWjFFoxRaMUWjFFoxRaMUWjFFoxRaMUWjFFoxRaMUWjFFoxRaMUWjFFoxRaDYuussvtrZcQbeQckOooTcFntp/Y4SXRiG7bsmdf8A1RFi7bGX9kxLtsdxGK/LHwWe2n9jhJdGIbtuyZbYRrR/smu1EX0XBZ7af2OEl0Yhu27JlthGtHxcndI3gyW3fKeWWVqiWELSvyzXaiL6Lgs9tP7HCUmW2MohlPl17JlthGtHwkrt9Ai66t13BErNRKGxbYvR/kmu1EX0XBZ7dl38X5WtGVLQ4uChwMEMR1LTdky2wjWj4Piiql1DbFyuQ/sP0ChCVFbVX5JrtRF9FwWe32MjCasvsttss7JlthGtHwW21sWFXfwanOsUEylRYS0iHW1q7/kmu1EX0XBZ7ZNKXHY82DHmwJmpCmr3TLbCNaPhLkNSFwSrlKUHnmqDBEENU6T8k12oi+i4LPbT+x4ZlthGtHwVJy1RDpH1SS6tPipRV5t7LG7v78L7IDbj2t/VJjy77TS/DNdqIvouCz20/seGZbYRrR9l5JZgsstsp4ZU78u3hFHXkmeGa7URfRcFntp/Y8My2wjWj80hdaNye66t1xdlxpixKajUCMuv3SPBNdqIwZZax84sOTqmQkX3VvubCqnOHhmW2Ea0fffdSyx9ejFpzY6KEByJUWsT8HNaW3pVikxWoEXaPrFyJro4Jq0rSqY8xMe1ri3BJ3zXa9sPba0r4ZlthGtH3yZ5+zfwYnS5tUFGWmlnG2ElPTle5KhFmjnXcJY1fHBkcrm1WXfaaX3TXaglvVnl9KXgplcTKtcYoXdSlKU8My2wjWj7pS8/zwbURq9U+tN7YcI08fSMkzv9w0MDVVxU2W0ss4XUpdbIGurcqEUdeSZ3TXaiL6LyzLbCNaPtkjx9Iuv+apiDFJ7O3FtqVWnLVJ3ZvMblXBtRGL1SJMWjTdjgkLXJVyUxGpEZdfukds12oi+i8sy2wjWj7H10sbU5plxpllt198fabW4jg5oSnBKtSmolIhqwizvkTX1BNWnxVMeYmPa1xbgk7JrtRF9F5ZnthGK0qx8XReU3JVikxYoEZZvq2dj412OSY4q8k22tbbo670cCe6WNXxUMjlc2qy77TS+MzrSrsIvovLNkta2hmeDmwZaWMtLGWlh1XmuKoNKkhIqy0sZaWMtLGWljLSxlpYfHJO5VCc4xOdbLbP5y0sZaWMtLGWljLSxdKybrT6l3HBkfbm4nLSxlpYNlv+ik8xSfbbW+5vI+qh8qkixSQ7tZzad+6MslxV/nMstMsUxpAbXFEwxRMMUTDFEwxRMMUTDFEwxRMMUTDFEwxRMMUTDFEwxRMMUTDFEwxRMMUTDFEwxRMMUTDFEwxRMMUTDFEwxRMMUTCkUS/KFoRIq/8T//xAAUEQEAAAAAAAAAAAAAAAAAAACQ/9oACAEDAQE/ARA//8QAFBEBAAAAAAAAAAAAAAAAAAAAkP/aAAgBAgEBPwEQP//EAEEQAAEDAAUGCggGAgIDAAAAAAEAAgMEEBE0sSEzkZKh0RIgMDFBUXFyc6ITIjJAUmGCshQjJEJiwUOBY4AFUFP/2gAIAQEABj8C/wCk/Blltf8AA3KVkgm2K7zbFd5tiu82xXebYrvNsV3m2K7zbFd5tiu82xXebYrvNsV3m2K7zbFd5tiu82xXebYrvNsV3m2K7zbFd5tiu82xXebYrvNsV3m2K7zbFd5tiu82xWP9JF3xkQfG4OaeYg+4OolDdY7/ACPHR8h7/aw8KI+1H1pk0RtY8Wjlp5/gaSO1FzjaTlJTIYW8J7sgCHpaV638Wq9P1Fen6ivT9RXp+or0/UV6fqK9P1Fen6ivT9RXp+or0/UV6fqK9P1Fen6ivT9RXp+or0/UV6fqK9P1Fen6ivT9RXp+or0/UV6fqK9P1Fen6ivT9RBxcJIXZA8VT0VxyD12/wB8tSfp+4VPt6IjiPfaTb0WYip3hHEctSfp+4VSeCcR77SuwYip3hHEctSfp+4VSeCcR77SuwYip3hHEctSfp+4VSeCcR77SuwYip3hHEclacgRjoDQ8/8A0dzf6VppTx3civc2sjHNSJXsPOC6rhwSOjdZZa0q9zayvc2sr3NrK9zayvc2sr3NrK9zayvc2sr3NrK9zayvc2sr3NrK9zayvc2sr3NrK9zayvc2sr3NrK9zayvc2sr3NrK9zayvc2srRSnnvZUI6e0M/wCRvN/tWjKK6V2DEVO8I4jkvwMJs6ZN3/oPwMxt6Y91dK7BiKneEcRyVIkPTIUGjnORNa2NrpP3PIylZtmhZtmhZtmhZtmhZtmhZtmhZtmhZtmhZtmhZtmhZtmhZtmhZtmhZtmhZtmhZtmhZtmhZtmhZtmhZtmhZtmhZtmhZtmhZtmhZtmhZtmhZtmhOa6NrZP2vAyhFp5xkVGkHQ8V0rsGIqd4RxHJS94qDvjH36fvnFRd4V0rsGIqd4RxHJS94qDvjH36fvnFRd4V0rsGIqd4RxHJS94qDvjH36fvnFRd4V0rsGIqd4RxHHslpLAeoZcFePI7crx5Hbk8jmLionO5g4Eq8eR25XjyO3K8eR25XjyO3K8eR25XjyO3K8eR25XjyO3K8eR25XjyO3K8eR25XjyO3K8eR25XjyO3K8eR25XjyO3K8eR25XjyO3K8eR25XjyO3K8eR25XjyO3K8eR25XnyO3LhUeVkg/ieLP3ziou8K6V2DEVO8I4jiue82NaLSSnR0cmOjfLnd2+/B8L3MeOkL0FIsFJHT8fEn75xUXeFdK7BiKneEcRxY6Mw53K7sqLaOy2znceYLO0fSdyztH0ncs7R9J3LO0fSdyztH0ncs7R9J3LO0fSdyztH0ncs7R9J3LO0fSdyztH0ncs7R9J3LO0fSdyztH0ncs7R9J3LO0fSdyztH0ncs7R9J3LO0fSdyztH0ncs7R9J3LO0fSdyztH0ncs7R9J3LO0fSdyztH0ncs7R9J3Ilphk+TXZUWvBDhkIKZLGbHsNoUUzeZ7Q6ufvnFRd4V0rsGIqd4RxHFYOqIYmqAtGV9rjp99taPbjDjtH9VUa35/ca5++cVF3hXSuwYip3hHEcVvhDE1UXsOJ99j8EYmqjfV9xrn75xUXeFdK7BiKneEcRxW+EMTVRew4niWSv4UnwNylflUUWfyerKRRi0dbHWrh0aQPHT8vdo/BGJqo31fca5++cVF3hXMHHK+xo01PPVEcRxW+EMTVRew4msRQn9RJzfxHWi5xJcecmts0DrHDamTx9POOo+6x+CMTVRvq+41z984prh0G1Zqj6DvWao+g70HUl9tnM0cwqkpLxncjewcVvhDE1UXsOJrpDzzB3BHYKmvpzn+kP7G5LF6ejuc6HmcHc7apqOfZc3hjtHusfgjE1Ub6vuNc/fOPFbJSGmOjfPncgxgsaBYAOK3whiaqL2HE1ztPOHkbUx3PYbUyWJ3CY4WgqVjj68vqtFVvwxn3WPwRiaqN9X3GufvnFMB5i4K7+d29Xfzu3q2KjMB6zlx47fCGJqovYcTX+JaPyptjqiKPO+MHoBXDnkdI7rcanUiQWPm5u77rH4IxNVG+r7jXP3ziou8OSb4QxNVF7Dia3Qzt4THIuhaZ4etvOO0LKuDExz3dTRamzf+QFjRzRdfbyRhoEnAjbkLxzuTfxEjpoT7QdlKa+M8JjhaDyUfgjE1Ub6vuNc/fOKi7w5JvhDE1UXsOJ4v5kbHdoVjGho+Q5I0KjO9c5xw6PlWKHO78tx9Q9R6uSj8EYmqjfV9xrn75xUXeHJN8IYmqi9hxPL8GO8P9kdXzRc42uOUlNZGC57jYAE6GdtjxV6CY/qIxrDr5GPwRiaqMC9oPrdP8is4zSnOdI10n7WA5Si485yqjRjpeOSb4QxNVF7DieQLnkBoyklFkD3Mow5gMnC+ZQcx7nM/cwnIU2aE2sdsrdNL9LfiKfNMbXuqFKpDfz3D1Qf2hcKMfqI/Z+fyVhyEJk0Jse02hNmj5+Zzeo8hH4IxPG/HTCzoj38k3whiaqL2HE8gaLRnfkN9pw/ed1eW0wP9tv8AabJG4OY4WghOkldwWNFpK4ZyRNyMb1VCmUlv5TfYaf3HrrNOo7fFAxqD+eJ2R7U18Z4THC0Hjx+CMTUJIaPK9h5iGq6TaqsFFeO9kQkp7g//AI283+1YMg5JvhDE1UXsOJ47qFRXetzSOHR8qmww/wCz8IQstfA72Xf1V+HpB/TOPP8AAV+Ho7v07DlPxmq19oo7PbPX8kGsFjRkAFZDhaDzhepd35WHq+VQoc7vy3H1D1Hq48fgjE1Ub6vuPLN8IYmqi9hxPG9BRz+pcOf4AsqZDC3hPdzL0bMsh9t/WU+GZtrHIxvytOVjusVthi/2eoJkMIsa3bxXwS8x6eo9afBMPWbtq9BMf1EY1h18aPwRiaqN9X3Hlm+EMTVRew4ni5LDO/2G/wBp0kji57jaSUGsBLjkAC4UlhpL/aPV8qzDL9LvhKdDMLHDbU+iuaGzPNod8Xy4/CjH6iP2fn8lYchTJoTY9ptCbNHz8zm9R4sfgjE1Ub6vuPLN8IYmqjWdFuJ4hlkyn9rfiKfNMbXu2VClUlv57vZaf2DfxbMgnb7Dv6To5Wlr2mwgoOabCOYr0cpspLBl/l8+OadR25P8oGNQfzxOyPamvjPCY4Wg8RlnRELdJqo31fceWgpTRkHqO/qotDRJC7KWFXV+urq/XV1froyyZB+1vwioTUiEzcH2Rb0q6v11dX66ur9dXV+urq/XV1frpr20d0cw/dbzipksLuC9ptBQ4dFdwumxyur9dXV+urq/XV1frq6v10WuobiDkI4SeYWlsZOQHoqdDIwyx87cvsq6v11dX66PoaL638nJ80zuE9xtJQa0WuOQBQQ/A0A9vLPhlFrHiwqx44UR9mTr9/FLpjbHf42Ho+Z9wLJGhzTzghWs9JF3DkV4m2K8TbFeJtivE2xXibYrxNsV4m2K8TbFeJtivE2xXibYrxNsV4m2K8TbFeJtivE2xXibYrxNsV4m2K8TbFeJtivE2xXibYrxNsV4m2K8TbFeJtiyzzbFwoYrX/G7Kf8ApR//xAArEAABAgMGBwEBAQEBAAAAAAABABFR0fEQITFBYfAwQHGBkbHBoSBQgHD/2gAIAQEAAT8h/wCJzEMOIWusO6HvUas+qsTKsTKsTKsTKsTKsTKsTKsTKsTKsTKsTKsTKsTKsTKsTKsTKsTKsTKsTKsTKsTKsTKsTKsTKsTKsTKsTILMU5+0HV7h92B78g0krsVsXlEuXOPPA5hV8buiB1V9bw40aNUZP1G8FuMyiAC0BOHGcXY7k3qjJqjJqjJqjJqjJqjJqjJqjJqjJqjJqjJqjJqjJqjJqjJqjJqjJqjJqjJqjJqjJqjJqjJqjJqjJqjJqjJogaBgZjAjKxwAzpZfHGJmbAcAcnjQsfedbQ96NDZE2r/4unxONk+JxsnxONkMygAck5IasXH0GfVFeimD+Kv01ZN2IN72EhVcYFofir9V+q/Vfqv1X6r9V+q/Vfqv1X6r9V+q/Vfqv1X6r9V+q/Vfqv0F6KYP6j+43D1GXVCRQQOCM+PGyAjEwOM3w+/H+ASsTE5ybH788eNkM65N7Pd+IBrnAdUwF1zEnwaKiVRKolUSqJVEqiVRKolUSqJVEqiVRKolUSqJVEqiVRKolUSqJVEqiVRKolMBNgxPo0QDWOS6ojLF/wBHv/OPGyblFbXBz21xLco8eNk3KK2uDntriW5R48bJuUVtcHPbXEtyjxI2QpHuJHjs5alTUqHHcgPKIUx40BWpU1KmpU1KmpU1KmpU1KmpU1KmpU1KmpU1KmpU1KmpU1KmpU1KmpU1KmpUaVzqBI8IZLdf52uJblHhRsggJzAAEPPLsmro057DCAdigBcq4C4BPT+NriW5R4UbI0sJXcOXc+rGYzHG6p5y8ePHjx48ePHjx48ePHjx48ePHjx48ePGygzjvIARfqsDEFNkpNqFg84EHGFu1xLco8KNkMTsGFgJgCGxLh6A50CEB1KX+Cwp8A+AW7XEtyj/AJ0bJkjE/triW5R5CNkyRr01XYd08so3D+BDO3IBb2oMtC49Qy5sn9tcS3KNonAILEsPoGw4bB1wjJGIImr2x0RsSOQ5JtNDxwyCB0Vxhg88OaJ/bXEjMBxA9p68zEYY3RFjDwlf+bufXCyRjLOT4werCCEF3WaTEoDHZGYGBfMWEEwZqN6P5zRP7a4v5Fm1+TRGmqGpHYABwskbHfd5J2Rc2RYoFJmCH2uMybwSe1h0OBJ/B95on9tcSGO4A+VqVNSoEjXADx3dxMkbVjCO4O+PmwHiUXDwjAyxBsu7wacgw8y5on9tcS3KPHyRh+AmI+jVZTqgcWy8IhABBGIKBjDgYSJAr445kaIAAAAMBwX1CzM0OQTsdMQwIgocUAFgRxyf21xLco8jkjGnKxGVo5xrhYVHpP0c7Ys28/0Pvrxyf21xLco83kjOUBG0LGjYjXBckrPigAlfkGpERZ19w7xjwyYYQwEAiiUwF2LE+DVENc5LqgMuX/R7/wA5TJGDtVwYAK79CQ7cwTl85M/DqmL47lmDraWp2uzMgJ/uX0AyA0s8sy19KZYAnOFTMJIYg5K+Y8K7c6lnjjEyViYjOb4/PnlMkbGiNwwftuPbN8GqyOQGIQnjssgiFzpGj1NmPwaQ9Ba+uA7X3Wy+pc1mI9QhxQAWBHBJvWTdiDeyr9BeqmD+o9nF49xn0QkEADADLk8kZjeC9vD9sChebz4RCigeJozi1sIHIovJ0innKQ8nQWNYJv6VB2isFwFoQgTEwITxAkp9h6WRZt5/offXnyf2SMI+dQeTrBESEiSbySjoi2BBDF9YvlJnF2IhqNU/ngjdOtH2z35ecSmY67lmTr/Iabu7NlAmOBscgyI0s664d4x50n9kjYZs30aLM5AYlHWuwOSUyIJ0MNo1WOIMYifHvHIMiNLNqWPQ/sbeac4d7kQwSAsQclfMeFdudSzxypP4G1bEfQ9ydD/EcfJGb4CfrzsEBpZhRWwYv5YDFfu0KgLDMUVAU4CxBTBVzYIPv948DojvfZfUuazEeoQ4oALAj+BgTkfQXPtgM7xg4Ad0s/qwoaBwZjEHJUZJUZJUZJXILcM3QLCZK8MABEVRklRklRklRklRklRklcR3LJEI3WHaMwWU0gX0uVGSVGSVGSVGSVGSQkTuBYjwnw2D3IQex+GWQ0ln2VGSVGSQmGcpfA7AXogBMDWiQBmVHHVGb9411bwRYYVdC7QYHTngHLC8pqbX4rYuHIXOH3YHsisRTl6RdUiRUiRUiRUiRUiRUiRUiRUiRUiRUiRUiRUiRUiRUiRUiRUiRUiRUiRUiRUiRUiRUiRUiRUiRUiRUiRUiRD3qIBnxDYIc3xQ7f8AFH//2gAMAwEAAgADAAAAEPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPOLDDDDDDDDDDDDDHNPPPPPPKDLDDDDDDDDDDDDHPFPPPPPPKPPPPPPPPPPPPPPPPFPPPPPMKPPPPPPPPPPPPONPPFPPPPOPPPPPPPPPPPPPPPPPPFPPPPKPPPPPPPPPPPPPPPKPPFPPPOIOMMMMMMMMMMMOPPKPPFPPFPMMMMMMMMMMMMMNEPKPPFPPFPPPPPPPPPPPPPPPKPKPPFPPFPOFPNPPPPPPPPPPKPKNPHPPFPKFHNPPPPPPPPPPKPOMLHPPFPLJONPPPPOPPPPPKPKPPPPPFPPLPPPPOMIPPPPPKOLPPPPPFPPPPJLOBLDLNPPPOOJPPPPPFPPPPLFHOPPHFPPPKPPPPPPPFPPOBPLMMPPLHGPPKPPPPPPPMPDPDDDHPDDDPLDCPPPPPPPPPLDDDDDDDDDDDDDPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPP/EABQRAQAAAAAAAAAAAAAAAAAAAJD/2gAIAQMBAT8QED//xAAUEQEAAAAAAAAAAAAAAAAAAACQ/9oACAECAQE/EBA//8QAKxABAAEDAgYCAwACAwEAAAAAAREAIUExURBhcYHB8DBAIJGhULGA0eFw/9oACAEBAAE/EP8AhPmXeS2BZckUgMPSz2n9zFixYsWLFixYsWLFixYsWLFixYsWLFixI76IrLqw6oUXroEfcFn6CZRyMM5sMaFzQhGkRFTKur941c9KsvI6DvJah7AZ8ZEwjImEfmKAE6dIIL1QUyZqEqMq81aiZHVr6quABVwDSGRJnW2APVB0+2wYMGDBgwYMGDBgwYMGDBgwYMGDBgwYMDBPOhNcaW1m+ZIKXRh6cG8QWuhYOkz6rv8AMz1DB7J8BSoN5mOyO/3YUkHuC8ft/fBxjYT+3x/8XhWwqMK2FRhWwqKrTLwAuq4KZpqG38lHqIckvUoF2V2JXt3mtEqhjAkdkHtwa2pszRZGJD2r27zXt3mvbvNe3ea9u817d5r27zXt3mvbvNe3ea9u817d5r27zXt3mvbvNe3ea9u817d5r27zXt3mvbvNe3ea9u81CBd1di02RwFvxLL0FOQXoTpl5A3EcnzwqK6ZZ4dTpRC3nm/wC+RZ5dTpRI2jk+eFRYYETgMHYB2qE8J3TB/Wo607ytFNTQW7y1614r1rxXrXivWvFeteK9a8V614r1rxXrXivWvFeteK9a8V614r1rxXrXivWvFeteK9a8V614r1rxXrXivWvFeteK9a8V614r1rxXrXip6sxOLVDU1Vu8NQHhOwYf6UiRNDKIO6Tv8APCo+53/4CJE9zt+eFR9zv/wESJ7nb88Kj7nf/gIkT3O35IVFL1w87ZBDyePbNK8ZxEikat6vxYCrBfQ+xmzZs2bNmzZs2bNmzZs2bNmzZs2YwSnRM/bApuD6megXHr+UT3O34oVFiWHQIlV2ClSokSfc1Fj95x91Try2Xcxy0akMhEBdUMHVFkuWkPwie52/FCopecmQykLkk8I6oTetpzHYl5WocJB2+3SJEiRIkSJEiRIkSJEiRIkSJEiRIkSJEq9zG9D/AHlJQasCYRHRGkXiHhJvuYTJQPRLCbBVzGTt+ET3O34oVF8GDHV+BlCUXji9h2+7GKeiNWfrgJsqdmF/A/CJ7nb/AI+FRowlsMT3O36EKjRhNMcSGcjUHeJxNMAY2UnYI/bSMK3EztUQbKC4ez3XUvj7i2GJ7nbxd4Wm88DortwKBkV1M+KjCk1GwjjYbrJhIuIUciYJXVW68UhLuZx5W3chBoj7a9lPV/2ORHP21sMQakQaFGSf1wIrjAO9UYMwvW15juy87cG3GQLyMjkkfFowlsiWbC2ut3VaBUAlaBhdhlkyIoZiAZL61aeSJRRAARQ0EU1m1LNjIbAFHW70/fWwxErQNCfZbi/8zgXWnQIgA2D4qMICUPXcBogUNvYMfyhCSc1HDsmiYRKWhJdu2hsBZ3gzwBVmvEKX9H21sMSF4zmJECcc3ZL/AMvO3EQ9PkowplLKSwEJtAhu8nBuBS/N3laecTQYSiaRsToci3BCNikMiXKSvQX21sMT3O356MKSSp2RwmA3GpQxXl4Be3MM20pM7QCEeZWtv0T2BaZOAcI1JljkXcxok2BABAHwKAqwGaRctBw9dpdEu6zDUDDZM2feTWFh0tqOfkuVEifQWwxPc7fo0YR8ly3+lcqjA/o+KyRARqml2OwYyxwtxX1szVsum3Uj51sMT3O37dGFKz9V8CGxgdXkNI5jIiZVXVWjEiOlTAFWPHUGVEiZHfzQoiMJRXGK/cLHMLHY5Y+JbeP5eHLWvWvNT0JiYuwg6mqt3gqQ8J3TL/WlaBoYBV2C9vqUYTSHwwiVXAFJ09c7iC8OFoc5qHQUq5pD2Bc5kiH+Yh6BYDZPEcZTSyMJLP8AtcAtXHko6JYBYOFrCyVzapgtchbKVM8DS5FPPU2dhaVaQeFFkTDTiSg6cxMiSJkWmKH1EiLnLI5E+ZavlSeHQ6USN55Pp0YTYl0ptLKiwOg5T9r6BxHqGDvGA9n9LbIchzEq0Sl3YbsH+3Yy2q99SHLq6QvY0Dhe0kksjUb2m6bF+Gu5ELR0Cc9Ox3cJgR2+dicxTuZpz8lyokT4VuiVQxpQmyJ2r27xUoF2V3ZTRjEVniWHoAc0tQnTDwAsAYPp0YWg2OjmUMuWNNZioAtjpJr4jKhViTN8IXhsak3OiFOLbqzN/tdGNd5aYLp2H+sW7faKinAC0tRN3LgvqklM/DBEAGAOL7vEyghEyJSZ/gvLVTfDcjMxVuK+tmatl026kfeWw0YRjW+EzZc+GNXEqEZQlV1VqLg2/wBVwBKuAqxIFs5DYSgd9VoE2JSsJgNxoS5YMJWvIaJh5IvDP4eSN/6QZUKs5Ol6hZTd/wCvxkFyiJB+wP7JNFqy6sGr1WUX/mpQoiMJRXmK/cLHMLHY5Y+4thowrrLFsxhPZ/W26PIcxKtVoVy5YTABlWomTx3NSXYy5eQccJh6Yth/pMn7rSHUNfq8r/xuJwemGluQ1ro3IFmXOv5Q0H6DOp567HYWmuiChRqJhpxJQdOYmRJEyLTFD6iRFzlkcifVWwstLKP0+OEISBzBaf5+/wACJJMQi2GxlcHOBWnJMWwCwCweaBUAlcUGpFJdDVMBrsW1X8X0CqDRz6w33FqKCIQ91zRy/MgmRE0RqDyGgR2i30gaN9Ej8tYhIGpYJz05ocrwkBHb52JzFO5mnPyXKiRPwFKAjkL9B78FKIYfZc+ZNEhhoWTpMeqb8J7jS2sWzJAGyMHWiAknlxDBgq7Knkyw3XVcvKAqECfMroZTBvfB+bBgwYMGEa7n7UILmHaTaKFj7COyZEkTIpRARHMxwvBlE7/kwYMGDBHFUVRCJqEpqJDrV5ZRpO3C2S4jDYKN2sYZ34sGDGCkTq3QPRJ1qZkZWl0AMAABgCiCJBKzAHNWhmRejSCWdUvzB2Q07GEcIwjhCmNT0qxyHVdpL/eQgUYAJVpBh4GETSwxqXNWGPoF66BH2VZpPbTBZdGHQT7mLFixYsWLFixYsWLFixYsWLFixYsWLFiIOfqz3nWmNuEu6bLmD/hR/9k='.'" alt="" />';

                                    // iframe
                                echo <<<EOD
                                <iframe class="description"
                                scrolling="no"
                                style="border:0px solid black;"
                                src="
                                EOD;
                                echo $view["router"]->path(
                                "beefree_theme_preview",
                                ["objectId" => $themeInfo->getId()]
                                );
                                echo <<<EOD
                                ">
                                </iframe>
                                EOD;
                                }

                                // if base64 decoded or else
                                else
                                {
                                    echo '<img src="data:image/jpeg;base64,'.base64_encode($data).'" alt="" />';
                                }
                                ?>
                            </div>

                            <div class="bf-item-text">
                                <div class="bf-item-text-wrapper">
                                    <p class="bf-item-text-dek"><?php echo $themeInfo->getName(); ?></p>
                                    <h2 class="bf-item-text-title"><?php echo $themeInfo->getTitle(); ?></h2>
                                    <a href="#" type="button" data-theme-beefree="<?php echo $themeKey; ?>" class="btn btn-default bf-item-text-title" style="margin: 50px auto;background-color: rgba(255,255,255,0.5);padding: 20px;">
                                        <?php echo $view['translator']->trans('mautic.beefree.builder'); ?>
                                    </a>
                                </div>
                            </div>
                            <a href="#" type="button" data-theme-beefree="<?php echo $themeKey; ?>" class="bf-item-link select-theme-link btn-dnd btn-nospin text-success btn-builder btn-copy " onclick="Mautic.launchCustomBuilder('emailform', 'email',this);">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
    <div class="clearfix"></div>
</div>
