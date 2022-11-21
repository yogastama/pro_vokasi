<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <style>
        body {
            padding: 0px;
            margin: 0px;
            background: white;
            font-family: roboto;
            overflow-x: hidden;
        }

        .empty {
            display: block;
            width: 100%;
            height: 20px;
        }

        #new-scanned-result {
            width: 100%;
            background: white;
            text-align: center;
            overflow-x: hidden;
            overflow-y: scroll;
            padding: 0px;
        }


        #logo {
            text-align: center;
            padding: 10px;
        }

        #logo img {
            height: 40px;
            background: #ffffff66;
            border-radius: 5px;
            padding: 0px 5px 0px 5px;
        }

        #scanapp-top-container {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        @media(max-width: 600px) {
            #scanapp-container {
                display: block;
            }

            #scanner,
            #workspace {
                display: 100px;
            }

            #reader {
                width: 100%;
                margin: 0px;
                padding: 0px;
            }

            #new-scanned-result {
                display: none;
                position: fixed;
                top: calc(25%);
                border-radius: 30px 30px 0px 0px;
                height: calc(75%);
                border: 1px solid black;
            }

            div.workspace-header {
                display: none;
            }

            div#no-result-container {
                display: none;
            }
        }

        @media(min-width: 600px) {
            #scanapp-container {
                display: flex;
            }

            #scanner {
                flex: 2
            }

            #workspace {
                flex: 1;
                border: 1px solid silver;
                /* border-bottom: 1px solid silver; */
                margin: 20px;
                margin-top: 60px;
            }

            #reader {
                width: 80%;
                margin: auto;
                padding: 0px;
            }

            #new-scanned-result {
                display: none;
                /* height: 100%; */
            }

            div.workspace-header {
                text-align: center;
                font-size: 20pt;
                font-weight: bold;
                background: #dadada;
            }

            div#no-result-container {
                text-align: center;
                font-size: 14pt;
                padding: 50px 0px 50px 0px;
            }
        }

        #history {
            display: none;
        }

        div#no-result-container.hidden {
            display: none;
        }

        #new-scanned-result {
            width: 100%;
            background: white;
            text-align: center;
            overflow-x: hidden;
            overflow-y: scroll;
        }

        div#new-scanned-result .header {
            margin: 10px;
            font-size: 18pt;
            font-weight: bold;
        }

        div#new-scanned-result .image {
            display: block;
            width: 200px;
            height: 100px;
            border: 1px solid #00000040;
            margin: auto;
            background: silver;
            margin-bottom: 15px;
        }

        #footer {
            margin-top: 100px;
            border-top: 1px solid silver;
            font-size: 9pt;
            font-weight: 400;
            background: #8080804a;
            padding: 50px;
            text-align: center;
        }

        div#scan-result-parsed {
            background: #dadada54;
            color: black;
            border: 1px solid #b3b3b333;
            padding: 5px;
            font-family: consolas;
            word-break: break-word;
        }

        table#result_table {
            /* border: 1px solid #c0c0c04a; */
            width: 80%;
            margin: auto;
            text-align: left;
            padding: 5px;
        }

        .action_image {
            width: 20px;
            padding: 10px;
            border: 1px solid #c0c0c066;
            border-radius: 10px;
        }

        .action_image:hover {
            background: #c0c0c06e;
        }

        #body-footer {
            margin-top: 20px;
            border-top: silver solid 1px;
            padding: 10px;
        }

        /** Badge **/
        :root {
            --color-primary: #214fe0;
            --color-dark: #1d1f20;
            --color-light: #f4f4f4;
            --color-shade: #bbb;

            --badge-size: 150px;

            --lock-color: #fff;
            --lock-width: 20px;
            --lock-stroke: 2.5px;

        }

        .badge-icon,
        .badge-text {
            padding: 5px 5px;
            float: left;
            -webkit-box-flex: 1;
            flex: 1;
            text-align: center;
            font: normal small-caps normal 10px/1.5 Arial, Helvetica, sans-serif;
            text-transform: uppercase;
            text-align: left;
        }

        .badge {
            display: inline-block;
            color: var(--color-light);
            /* min-width: var(--badge-size); */
            border-radius: 5px;
            overflow: hidden;
            border: 1px solid silver;
        }

        .badge-icon {
            background: silver;
            max-width: calc(var(--badge-size) / 4);
            color: black;
        }

        .badge-text {
            color: var(--color-dark);
            background-color: var(--color-light);
        }

        /** Banner */
        .banners-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 5;
        }

        .banner {
            color: white;
            font-weight: 700;
            padding: 2rem;
            display: flex;
            flex-direction: row;
            align-items: center;
        }

        .banner .banner-message {
            flex: 1;
            padding: 0 2rem;
        }

        .banner .banner-close {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .banner .banner-close:hover {
            background: rgba(0, 0, 0, 0.12);
        }

        .banner.success {
            background: #10c15c;
        }

        .banner.success::after {
            background: #10c15c;
        }

        .banner.error {
            background: #ed1c24;
        }

        .banner.error::after {
            background: #ed1c24;
        }

        .banner.info {
            background: #0b22e2;
        }

        .banner.info::after {
            background: #0b22e2;
        }

        .banner::after {
            content: "";
            position: absolute;
            height: 10%;
            width: 100%;
            bottom: 100%;
            left: 0;
        }

        .banner:not(.visible) {
            display: none;
            transform: translateY(-100%);
        }

        .banner.visible {
            box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.12);
            animation-name: banner-in;
            animation-direction: forwards;
            animation-duration: 0.6s;
            animation-timing-function: ease-in-out;
            animation-fill-mode: forwards;
            animation-iteration-count: 1;
        }

        @keyframes banner-in {
            0% {
                transform: translateY(-100%);
            }

            50% {
                transform: translateY(10%);
            }

            100% {
                transform: translateY(0);
            }
        }

        .show-banner {
            appearance: none;
            background: #ededed;
            border: 0;
            padding: 1rem 2rem;
            border-radius: 4px;
            cursor: pointer;
            text-transform: uppercase;
            margin: 0.25rem;
        }

        /** iframe guard */
        #iframe-alert {
            position: absolute;
            top: 20px;
            left: 20px;
            width: calc(100% - 40px);
            height: calc(100% - 40px);
            background: rgb(242 242 242 / 98%);
            border: 1px solid #727272;
            box-shadow: -4px -4px 10px 1px #00000061;
            z-index: 10;
        }

        div#iframe-alert-image {
            text-align: center;
            margin: 20px;
        }

        div#iframe-alert-subimage {
            text-align: center;
        }

        div#iframe-alert-subimage img {
            max-width: 60%;
        }

        div#iframe-alert-section {
            font-weight: bold;
            margin: 50px 10px 10px 10px;
            text-align: center;
            font-size: 16pt;
        }

        div#iframe-alert-actions {
            text-align: center;
        }

        div#iframe-ad {
            text-align: center;
            margin: 20px;
            position: absolute;
            bottom: 0px;
        }

        a,
        a:visited {
            color: black;
            text-decoration: underline;
        }

        .welcome-ticket {
            position: fixed;
            background: #57ff74;
            top: 0;
            right: 0;
            left: 0;
            bottom: 0;
            z-index: 999;
            text-align: center;
            padding-top: 200px;
        }

        .error-ticket {
            position: fixed;
            background: #ff8457;
            top: 0;
            right: 0;
            left: 0;
            bottom: 0;
            z-index: 999;
            text-align: center;
            padding-top: 200px;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'G-2KZEP7DPYH');
    </script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">{{ auth()->user()->name }}</a>
        <div class="ml-auto">
            <a class="nav-link btn-logout text-light" href="{{ url('/admin') }}">Kembali</a>
        </div>
    </nav>
    <div class="welcome-ticket d-none">
        <div>
            <img src="{{ url('/images/logo/ivw2022.jpeg') }}" alt="logo" width="100px" style="margin-bottom: 30px;">
            <h1 style="font-size: 50px">
                VALID
            </h1>
            <div>
                <h3 class="category-valid">

                </h3>
            </div>
            <p>
                <span class="perusahaan-tiket"></span>
            </p>
            <p>
                <span class="no-tiket"></span>
            </p>
            <p>
                WAKTU : <span class="waktu-tiket"></span>
            </p>
        </div>
    </div>
    <div class="error-ticket d-none">
        <div>
            <h1 class="pesan-error-tiket" style="font-size: 50px;">

            </h1>
            <p>
                <span class="no-error-tiket"></span>
            </p>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-sm-6 mb-3">
                <div class="form-group">
                    <label for="code">TICKET ID</label>
                    <input @if( request()->get('type_device') == 'scanner') onblur="this.focus()" autofocus @endif type="text" class="form-control" name="code" id="code" inputmode="none">
                </div>
            </div>
            <div class="col-12 col-sm-6 mb-3">
                <div class="form-group">
                    <label for="choose_device">TYPE DEVICE</label>
                    <select name="choose_device" id="choose_device" class="form-control">
                        <option value="camera" {{ (request()->get('type_device') || request()->get('type_device') == 'camera') ? 'selected' : '' }}>Device Camera</option>
                        <option value="scanner" {{ request()->get('type_device') == 'scanner' ? 'selected' : '' }}>Scanner</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div id="scanner">
        <div id="qr-reader" class="d-none"></div>
    </div>
    <div id="workspace">
        <div class="workspace-header">Scanned result</div>
        <div id="no-result-container">Scan to get results</div>
        <div id="new-scanned-result">
            <div class="header">
                New <span id="scan-result-code-type">{code}</span> detected!
            </div>
            <div class="section">
                <div class="image" id="scan-result-image"></div>
                <div class="data">
                    <table id="result_table">
                        <tr>
                            <!-- <td>Parsed</td> -->
                            <td colspan="2">
                                <div>
                                    <div class="badge">
                                        <div class="badge-icon">
                                            <span><b>Type</b></span>
                                        </div>
                                        <div class="badge-text">
                                            <span id="scan-result-badge-body">{type}</span>
                                        </div>
                                    </div>
                                </div>
                                <div id="scan-result-parsed">{parsed result here}</div>
                            </td>
                        </tr>
                        <tr>
                            <td>Actions</td>
                            <td>
                                <img class="action_image" id="action-share" src="./assets/svg/share-svgrepo-com.svg">
                                <img class="action_image" id="action-copy" src="./assets/svg/copy-svgrepo-com.svg">
                                <img class="action_image" id="action-payment" src="./assets/svg/coin-svgrepo-com.svg" style="display: none">
                            </td>
                        </tr>
                        <tr>
                            <td>Text</td>
                            <td style="word-break: break-word">
                                <div id="scan-result-text">{text result here}</div>
                            </td>
                        </tr>
                    </table>
                    <div id="body-footer">
                        <button id="scan-result-close">Close and scan another</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="history">
            <div class="workspace-header">Scan History</div>
            <div id="history-list"></div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://blog.minhazav.dev/assets/research/html5qrcode/html5-qrcode.min.v2.3.0.js"></script>
    <script>
        let barcode = '';
        let QrResult = function(e) {
            let t = document.getElementById("new-scanned-result"),
                n = document.getElementById("scan-result-code-type"),
                o = document.getElementById("scan-result-image"),
                i = document.getElementById("scan-result-text"),
                a = document.getElementById("scan-result-badge-body"),
                r = document.getElementById("scan-result-parsed"),
                c = document.getElementById("action-share"),
                d = document.getElementById("action-copy"),
                s = document.getElementById("action-payment"),
                u = document.getElementById("scan-result-close"),
                l = document.getElementById("no-result-container");
            o.style.display = "none";
            let g = {
                text: null,
                type: null
            };
            u.addEventListener("click", function() {
                hideBanners(), t.style.display = "none", e && (Logger.logScanRestart(), e()), l.classList
                    .remove("hidden")
            });
            navigator.clipboard ? d.addEventListener("click", function() {
                hideBanners(), copyToClipboard(i.innerText), Logger.logActionCopy()
            }) : d.style.display = "none", s.addEventListener("click", function(e) {
                hideBanners();
                var t = decodeURIComponent(g.text);
                location.href = t, showBanner(
                        "Payment action only works if UPI payment apps are installed."), Logger
                    .logPaymentAction()
            }), navigator.share ? c.addEventListener("click", function() {
                hideBanners(), shareResult(g.text, g.type), Logger.logActionShare()
            }) : c.style.display = "none", this.__onScanSuccess = function(e, o, c) {
                l.classList.add("hidden"), n.innerText = function(e) {
                    return e
                }(o.result.format.formatName), i.innerText = e;
                let d = detectType(e);
                Logger.logScanSuccess(c, d), g.text = e, g.type = d, a.innerText = d, r.replaceChildren ? r
                    .replaceChildren() : r.innerHTML = "", r.appendChild(function(e, t) {
                        let n = document.createElement("div");
                        return s.style.display = t == TYPE_UPI ? "inline-block" : "none", t == TYPE_URL ||
                            t == TYPE_PHONE ? (createLinkTyeUi(n, e, t), n) : t == TYPE_WIFI ? (
                                createWifiTyeUi(n, e), n) : t == TYPE_UPI ? (createUpiTypeUi(n, e), n) : (n
                                .innerText = e, n)
                    }(e, d)), t.style.display = "block"
            }
        };
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function scanDatabase(code) {
            $.ajax({
                type: "post",
                url: "{{ route('scanner.present_event') }}",
                data: {
                    code,
                },
                success: function(response) {
                    if (response.status != 'OK') {
                        if ($('.welcome-ticket').hasClass('d-none')) {
                            $('.error-ticket').removeClass('d-none');
                            $('.pesan-error-tiket').html(response.message);
                            $('.no-error-tiket').html(code);
                            playSound('{{ url("/assets/not.mp3") }}');
                            setTimeout(() => {
                                document.getElementById("scan-result-close").click()
                            }, 5000);
                            setTimeout(() => {
                                $('.error-ticket').addClass('d-none');
                            }, 5000);
                        }
                    } else {
                        $('.welcome-ticket').removeClass('d-none');
                        $('.no-tiket').html(response.results.ticket_id);
                        $('.perusahaan-tiket').html(response.results.institution);
                        $('.waktu-tiket').html(response.results.time);
                        $('.category-valid').html(response.results.name);
                        playSound('{{ url("/assets/check.mp3") }}');
                        setTimeout(() => {
                            document.getElementById("scan-result-close").click()
                        }, 5000);
                        setInterval(() => {
                            $('.welcome-ticket').addClass('d-none');
                        }, 5000);
                    }
                    barcode = ''
                },
                error: function(error){
                    alert(JSON.stringify(error));
                }
            });
        }

        function insertParam(key, value) {
            key = encodeURIComponent(key);
            value = encodeURIComponent(value);

            // kvp looks like ['key1=value1', 'key2=value2', ...]
            var kvp = document.location.search.substr(1).split('&');
            let i = 0;

            for (; i < kvp.length; i++) {
                if (kvp[i].startsWith(key + '=')) {
                    let pair = kvp[i].split('=');
                    pair[1] = value;
                    kvp[i] = pair.join('=');
                    break;
                }
            }

            if (i >= kvp.length) {
                kvp[kvp.length] = [key, value].join('=');
            }

            // can return this or...
            let params = kvp.join('&');

            // reload page with new params
            document.location.search = params;
        }

        function playSound(url) {
            const audio = new Audio(url);
            audio.play();
        }
        $('#choose_device').change(function(e) {
            e.preventDefault();
            insertParam('type_device', $(this).val());
        });
        $(document).ready(function() {
            if ("{{ request()->get('type_device', 'camera') }}" == 'scanner') {
                $('#code').keydown(function(e) {
                    var code = (e.keyCode ? e.keyCode : e.which);
                    if (code == 13) {
                        scanDatabase(barcode);
                        barcode = '';
                        $('#code').val('')
                    } else if (code == 9) {
                        scanDatabase(barcode);
                        barcode = '';
                        $('#code').val('')
                    } else {
                        barcode = barcode + String.fromCharCode(code);
                    }
                });
            } else {
                $('#qr-reader').removeClass('d-none');
            }
        });
        let TYPE_TEXT = "TEXT",
            TYPE_URL = "URL",
            TYPE_PHONE = "PHONE NUMBER",
            TYPE_WIFI = "WIFI",
            TYPE_UPI = "UPI",
            Logger = {
                logScanStart: function(e) {
                    gtag("event", "ScanStart", {
                        event_category: "Start",
                        event_label: `embed=${e}`
                    })
                },
                logScanRestart: function() {
                    gtag("event", "ScanStart", {
                        event_category: "Restart",
                        event_label: "NA"
                    })
                },
                logScanSuccess: function(e, t) {
                    gtag("event", "ScanSuccess", {
                        event_category: e,
                        event_label: t
                    }), gtag("event", `ScanSuccess_${e}`, {
                        event_category: "codeType",
                        event_label: "NA"
                    })
                },
                logActionCopy: function() {
                    gtag("event", "Action-Copy", {})
                },
                logActionShare: function() {
                    gtag("event", "Action-Share", {}), gtag("event", "share", {})
                },
                logPaymentAction: function() {
                    gtag("event", "Action-Payment", {})
                },
                logAntiEmbedWindowShown: function() {
                    gtag("event", "Anti-Embed-Window", {})
                },
                logAntiEmbedActionNavigateToScanApp: function(e) {
                    gtag("event", "Anti-Embed-Action", {
                        event_category: "NavigateToScanapp",
                        event_callback: function() {
                            e()
                        }
                    })
                },
                logAntiEmbedActionContinueHere: function(e) {
                    gtag("event", "Anti-Embed-Action", {
                        event_category: "Continue",
                        event_callback: function() {
                            e()
                        }
                    })
                }
            };

        function showBanner(e, t) {
            hideBanners(), selector = ".banner.success", textId = "banner-success-message", !1 === t && (selector =
                    ".banner.error", textId = "banner-error-message"), document.getElementById(textId).innerText = e,
                requestAnimationFrame(() => {
                    document.querySelector(selector).classList.add("visible")
                })
        }

        function hideBanners(e) {
            document.querySelectorAll(".banner.visible").forEach(e => e.classList.remove("visible"))
        }

        function shareResult(e, t) {
            const n = {
                title: "Scan result from Scanapp.org",
                text: e
            };
            t == TYPE_URL && (n.url = e), navigator.share(n).then(function() {
                showBanner("Shared successfully")
            }).catch(function(e) {
                showBanner("Sharing cancelled or failed", !1)
            })
        }

        function createLinkTyeUi(e, t, n) {
            var o = document.createElement("a");
            o.href = t, n == TYPE_PHONE && (t = t.toLowerCase().replace("tel:", "")), o.innerText = t, e.appendChild(o)
        }

        function addKeyValuePairUi(e, t, n) {
            var o = document.createElement("div"),
                i = document.createElement("span");
            i.style.fontWeight = "bold", i.style.marginRight = "10px", i.innerText = t, o.appendChild(i);
            var a = document.createElement("span");
            a.innerText = n, o.appendChild(a), e.appendChild(o)
        }

        function createWifiTyeUi(e, t) {
            var n = new RegExp(/WIFI:S:(.*);T:(.*);P:(.*);H:(.*);;/g).exec(t);
            addKeyValuePairUi(e, "SSID", n[1]), addKeyValuePairUi(e, "Type", n[2]), addKeyValuePairUi(e, "Password", n[
                3])
        }

        function createUpiTypeUi(e, t) {
            var n = new URL(t).searchParams,
                o = n.get("cu");
            o && null != o && addKeyValuePairUi(e, "Currency", o), addKeyValuePairUi(e, "Payee address", n.get("pa"));
            var i = n.get("pn");
            i && null != i && addKeyValuePairUi(e, "Payee Name", i)
        }

        function isUrl(e) {
            var t = new RegExp(
                /^((javascript:[\w-_]+(\([\w-_\s,.]*\))?)|(mailto:([\w\u00C0-\u1FFF\u2C00-\uD7FF-_]+\.)*[\w\u00C0-\u1FFF\u2C00-\uD7FF-_]+@([\w\u00C0-\u1FFF\u2C00-\uD7FF-_]+\.)*[\w\u00C0-\u1FFF\u2C00-\uD7FF-_]+)|(\w+:\/\/(([\w\u00C0-\u1FFF\u2C00-\uD7FF-]+\.)*([\w\u00C0-\u1FFF\u2C00-\uD7FF-]*\.?))(:\d+)?(((\/[^\s#$%^&*?]+)+|\/)(\?[\w\u00C0-\u1FFF\u2C00-\uD7FF:;&%_,.~+=-]+)?)?(#[\w\u00C0-\u1FFF\u2C00-\uD7FF-_]+)?))$/g
            );
            if (e.match(t)) return !0;
            var n = new RegExp(
                /(http(s)?:\/\/.)?(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/g
            );
            return !!e.match(n)
        }

        function isPhoneNumber(e) {
            var t = new RegExp(/tel:[+]*[0-9]{3,}/g);
            return e.match(t)
        }

        function isWifi(e) {
            var t = new RegExp(/WIFI:S:(.*);T:(.*);P:(.*);H:(.*);;/g);
            return e.match(t)
        }

        function isUpi(e) {
            try {
                var t = new URL(e);
                return !(!t || null == t) && "upi:" === t.protocol
            } catch (e) {
                return !1
            }
        }

        function detectType(e) {
            return isUrl(e) ? TYPE_URL : isPhoneNumber(e) ? TYPE_PHONE : isWifi(e) ? TYPE_WIFI : isUpi(e) ? TYPE_UPI :
                TYPE_TEXT
        }

        function copyToClipboard(e) {
            navigator.clipboard.writeText(e).then(function() {
                showBanner("Text copied")
            }).catch(function(e) {
                showBanner("Failed to copy", !1)
            })
        }
        let HistoryItem = function(e, t, n, o, i) {
            this._decodedText = e, this._decodedResult = t, this._scanType = n, this._codeType = o, this._dateTime =
                i
        };
        HistoryItem.prototype.decodedText = function() {
            return this._decodedText
        }, HistoryItem.prototype.decodedResult = function() {
            return this._decodedResult
        }, HistoryItem.prototype.scanType = function() {
            return this._scanType
        }, HistoryItem.prototype.codeType = function() {
            return this._codeType
        }, HistoryItem.prototype.dateTime = function() {
            return this._dateTime
        }, HistoryItem.prototype.render = function(e) {};
        let HistoryManager = function() {
            this._historyList = [], this.flushToDisk = function() {
                console.log("todo: saving history to disk")
            }
        };
        HistoryManager.prototype.add = function(e) {
            this._historyList.push(e), this.flushToDisk(), this.render()
        }, HistoryManager.prototype.render = function(e) {
            e.innerHtml = "";
            for (var t = this._historyList.length - 1; t >= 0; t--) {
                this._historyList[t].render(e)
            }
        };


        function isEmbeddedInIframe() {
            return window !== window.parent
        }

        function showAntiEmbedWindow() {
            document.getElementById("iframe-alert").style.display = "block", Logger.logAntiEmbedWindowShown();
            var e = document.getElementById("iframe-alert-actions-navigate"),
                t = document.getElementById("iframe-alert-actions-continue");
            e.addEventListener("click", function t() {
                e.removeEventListener("click", t), e.disabled = !0, Logger.logAntiEmbedActionNavigateToScanApp(
                    function() {
                        window.parent.location.href = "https://scanapp.org#referral=anti-embed"
                    })
            });
            var n = 6;
            t.disabled = !0,
                function e() {
                    n--, t.innerText = `Continue here (${n})`, n > 0 ? setTimeout(e, 1e3) : (t.innerText =
                        "Continue using here", t.disabled = !1)
                }(), t.addEventListener("click", function e() {
                    t.disabled = !0, t.removeEventListener("click", e), Logger.logAntiEmbedActionContinueHere(
                        function() {
                            document.getElementById("iframe-alert").style.display = "none"
                        })
                })
        }

        function docReady(e) {
            "complete" === document.readyState || "interactive" === document.readyState ? setTimeout(e, 1) : document
                .addEventListener("DOMContentLoaded", e)
        }
        QrResult.prototype.onScanSuccess = function(e, t, n) {
            this.__onScanSuccess(e, t, n)
        }, docReady(function() {
            var e = isEmbeddedInIframe();
            e && showAntiEmbedWindow(), location.href = "#reader";
            let t = new Html5QrcodeScanner("qr-reader", {
                    fps: 10,
                    qrbox: function(e, t) {
                        var n = e > t ? t : e,
                            o = Math.floor(.8 * n);
                        return o < 250 ? n < 250 ? {
                            width: n,
                            height: n
                        } : {
                            width: 250,
                            height: 250
                        } : {
                            width: o,
                            height: o
                        }
                    },
                    experimentalFeatures: {
                        useBarCodeDetectorIfSupported: !0
                    },
                    rememberLastUsedCamera: !0,
                    aspectRatio: 1.7777778
                }),
                n = new QrResult(function() {
                    t.getState() === Html5QrcodeScannerState.PAUSED && t.resume()
                });
            t.render(function(e, o) {
                scanDatabase(e);
                console.log(e, o), t.getState() !== Html5QrcodeScannerState.NOT_STARTED && t.pause(!0);
                let i = "camera";
                t.getState() === Html5QrcodeScannerState.NOT_STARTED && (i = "file"), n.onScanSuccess(e,
                    o, i)
            }), Logger.logScanStart(e)
        });
    </script>
</body>

</html>