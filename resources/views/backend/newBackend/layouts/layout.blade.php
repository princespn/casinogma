<!DOCTYPE html>
<html>

<head>
    <title>GGinc | Home </title>
    <meta charset="utf-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <meta content="API Cashier" name="keywords">
    <meta content="Mr.Marlboro" name="author">
    <meta content="GG inc" name="description">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">

    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-title" content="API">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <link rel="shortcut" sizes="196x196" href="https://netpos.gapi.lol/img/256.png">
    <link rel="apple-touch-icon" href="https://netpos.gapi.lol/img/57.png" type="image/x-icon">
    <link rel="apple-touch-icon-precomposed" href="https://netpos.gapi.lol/img/256.png" type="image/x-icon">
    <link rel="manifest" href="https://netpos.gapi.lol/img/cashier-white/manifest.json">
    <meta name="csrf-token" content="wKh21i6UEoxYW2BlOsVV7t9gYsJ2lDyJzhQF3oJM">
    <link href="https://netpos.gapi.lol/img/cashier-white/img/favicon.png" rel="shortcut icon">
    <link href="https://netpos.gapi.lol/apple-touch-icon.png" rel="apple-touch-icon">
    {{-- start  --}}
    <link href="/back/netpos/bower_components/select2/dist/css/select2.min.css"
        rel="stylesheet">
    <link
        href="/back/netpos/bower_components/bootstrap-daterangepicker/daterangepicker.css"
        rel="stylesheet">
    <link href="/back/netpos/bower_components/dropzone/dist/dropzone.css" rel="stylesheet">
    <link
        href="/back/netpos/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css"
        rel="stylesheet">
    <link href="/back/netpos/bower_components/fullcalendar/dist/fullcalendar.min.css"
        rel="stylesheet">
    <link
        href="/back/netpos/bower_components/perfect-scrollbar/css/perfect-scrollbar.min.css"
        rel="stylesheet">

        {{-- End bower_components --}}
    <link href="/back/netpos/css/picons-thin/style.css" rel="stylesheet">
    <link href="/back/netpos/css/typicons/typicons.css" rel="stylesheet">
    <link href="/back/netpos/css/bootstrap.min.css" rel="stylesheet">
    <link href="/back/netpos/css/maina570.css" rel="stylesheet">
    <link href="/back/netpos/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="/back/netpos/css/summernote.css" rel="stylesheet">
    <link href="/back/netpos/css/alertify.css" rel="stylesheet">
    <link href="/back/netpos/css/bootstrap-toggle.min.css" rel="stylesheet">
    <link href="/back/netpos/css/pisoglentis.css?v=2.1" rel="stylesheet">
    <link href="/back/netpos/css/responsive.dataTables.min.css" rel="stylesheet">
    <style>
        .cke {
            visibility: hidden;
        }

    </style>
    <style type="text/css">
        body.swal2-shown {
            overflow-y: hidden;
        }

        body.swal2-iosfix {
            position: fixed;
            left: 0;
            right: 0;
        }

        .swal2-container {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: horizontal;
            -webkit-box-direction: normal;
            -ms-flex-direction: row;
            flex-direction: row;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            padding: 10px;
            background-color: transparent;
            z-index: 1060;
        }

        .swal2-container.swal2-top {
            -webkit-box-align: start;
            -ms-flex-align: start;
            align-items: flex-start;
        }

        .swal2-container.swal2-top-left {
            -webkit-box-align: start;
            -ms-flex-align: start;
            align-items: flex-start;
            -webkit-box-pack: start;
            -ms-flex-pack: start;
            justify-content: flex-start;
        }

        .swal2-container.swal2-top-right {
            -webkit-box-align: start;
            -ms-flex-align: start;
            align-items: flex-start;
            -webkit-box-pack: end;
            -ms-flex-pack: end;
            justify-content: flex-end;
        }

        .swal2-container.swal2-center {
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
        }

        .swal2-container.swal2-center-left {
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: start;
            -ms-flex-pack: start;
            justify-content: flex-start;
        }

        .swal2-container.swal2-center-right {
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: end;
            -ms-flex-pack: end;
            justify-content: flex-end;
        }

        .swal2-container.swal2-bottom {
            -webkit-box-align: end;
            -ms-flex-align: end;
            align-items: flex-end;
        }

        .swal2-container.swal2-bottom-left {
            -webkit-box-align: end;
            -ms-flex-align: end;
            align-items: flex-end;
            -webkit-box-pack: start;
            -ms-flex-pack: start;
            justify-content: flex-start;
        }

        .swal2-container.swal2-bottom-right {
            -webkit-box-align: end;
            -ms-flex-align: end;
            align-items: flex-end;
            -webkit-box-pack: end;
            -ms-flex-pack: end;
            justify-content: flex-end;
        }

        .swal2-container.swal2-grow-fullscreen>.swal2-modal {
            display: -webkit-box !important;
            display: -ms-flexbox !important;
            display: flex !important;
            -webkit-box-flex: 1;
            -ms-flex: 1;
            flex: 1;
            -ms-flex-item-align: stretch;
            align-self: stretch;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
        }

        .swal2-container.swal2-grow-row>.swal2-modal {
            display: -webkit-box !important;
            display: -ms-flexbox !important;
            display: flex !important;
            -webkit-box-flex: 1;
            -ms-flex: 1;
            flex: 1;
            -ms-flex-line-pack: center;
            align-content: center;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
        }

        .swal2-container.swal2-grow-column {
            -webkit-box-flex: 1;
            -ms-flex: 1;
            flex: 1;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
        }

        .swal2-container.swal2-grow-column.swal2-top,
        .swal2-container.swal2-grow-column.swal2-center,
        .swal2-container.swal2-grow-column.swal2-bottom {
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
        }

        .swal2-container.swal2-grow-column.swal2-top-left,
        .swal2-container.swal2-grow-column.swal2-center-left,
        .swal2-container.swal2-grow-column.swal2-bottom-left {
            -webkit-box-align: start;
            -ms-flex-align: start;
            align-items: flex-start;
        }

        .swal2-container.swal2-grow-column.swal2-top-right,
        .swal2-container.swal2-grow-column.swal2-center-right,
        .swal2-container.swal2-grow-column.swal2-bottom-right {
            -webkit-box-align: end;
            -ms-flex-align: end;
            align-items: flex-end;
        }

        .swal2-container.swal2-grow-column>.swal2-modal {
            display: -webkit-box !important;
            display: -ms-flexbox !important;
            display: flex !important;
            -webkit-box-flex: 1;
            -ms-flex: 1;
            flex: 1;
            -ms-flex-line-pack: center;
            align-content: center;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
        }

        .swal2-container:not(.swal2-top):not(.swal2-top-left):not(.swal2-top-right):not(.swal2-center-left):not(.swal2-center-right):not(.swal2-bottom):not(.swal2-bottom-left):not(.swal2-bottom-right)>.swal2-modal {
            margin: auto;
        }

        @media all and (-ms-high-contrast: none),
        (-ms-high-contrast: active) {
            .swal2-container .swal2-modal {
                margin: 0 !important;
            }
        }

        .swal2-container.swal2-fade {
            -webkit-transition: background-color .1s;
            transition: background-color .1s;
        }

        .swal2-container.swal2-shown {
            background-color: rgba(0, 0, 0, 0.4);
        }

        .swal2-modal {
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            background-color: #fff;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            border-radius: 5px;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            text-align: center;
            overflow-x: hidden;
            overflow-y: auto;
            display: none;
            position: relative;
            max-width: 100%;
        }

        .swal2-modal:focus {
            outline: none;
        }

        .swal2-modal.swal2-loading {
            overflow-y: hidden;
        }

        .swal2-modal .swal2-title {
            color: #595959;
            font-size: 30px;
            text-align: center;
            font-weight: 600;
            text-transform: none;
            position: relative;
            margin: 0 0 .4em;
            padding: 0;
            display: block;
            word-wrap: break-word;
        }

        .swal2-modal .swal2-buttonswrapper {
            margin-top: 15px;
        }

        .swal2-modal .swal2-buttonswrapper:not(.swal2-loading) .swal2-styled[disabled] {
            opacity: .4;
            cursor: no-drop;
        }

        .swal2-modal .swal2-buttonswrapper.swal2-loading .swal2-styled.swal2-confirm {
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            border: 4px solid transparent;
            border-color: transparent;
            width: 40px;
            height: 40px;
            padding: 0;
            margin: 7.5px;
            vertical-align: top;
            background-color: transparent !important;
            color: transparent;
            cursor: default;
            border-radius: 100%;
            -webkit-animation: rotate-loading 1.5s linear 0s infinite normal;
            animation: rotate-loading 1.5s linear 0s infinite normal;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .swal2-modal .swal2-buttonswrapper.swal2-loading .swal2-styled.swal2-cancel {
            margin-left: 30px;
            margin-right: 30px;
        }

        .swal2-modal .swal2-buttonswrapper.swal2-loading :not(.swal2-styled).swal2-confirm::after {
            display: inline-block;
            content: '';
            margin-left: 5px;
            vertical-align: -1px;
            height: 15px;
            width: 15px;
            border: 3px solid #999999;
            -webkit-box-shadow: 1px 1px 1px #fff;
            box-shadow: 1px 1px 1px #fff;
            border-right-color: transparent;
            border-radius: 50%;
            -webkit-animation: rotate-loading 1.5s linear 0s infinite normal;
            animation: rotate-loading 1.5s linear 0s infinite normal;
        }

        .swal2-modal .swal2-styled {
            border: 0;
            border-radius: 3px;
            -webkit-box-shadow: none;
            box-shadow: none;
            color: #fff;
            cursor: pointer;
            font-size: 17px;
            font-weight: 500;
            margin: 15px 5px 0;
            padding: 10px 32px;
        }

        .swal2-modal .swal2-styled:focus {
            outline: none;
            -webkit-box-shadow: 0 0 0 2px #fff, 0 0 0 4px rgba(50, 100, 150, 0.4);
            box-shadow: 0 0 0 2px #fff, 0 0 0 4px rgba(50, 100, 150, 0.4);
        }

        .swal2-modal .swal2-image {
            margin: 20px auto;
            max-width: 100%;
        }

        .swal2-modal .swal2-close {
            background: transparent;
            border: 0;
            margin: 0;
            padding: 0;
            width: 38px;
            height: 40px;
            font-size: 36px;
            line-height: 40px;
            font-family: serif;
            position: absolute;
            top: 5px;
            right: 8px;
            cursor: pointer;
            color: #cccccc;
            -webkit-transition: color .1s ease;
            transition: color .1s ease;
        }

        .swal2-modal .swal2-close:hover {
            color: #d55;
        }

        .swal2-modal>.swal2-input,
        .swal2-modal>.swal2-file,
        .swal2-modal>.swal2-textarea,
        .swal2-modal>.swal2-select,
        .swal2-modal>.swal2-radio,
        .swal2-modal>.swal2-checkbox {
            display: none;
        }

        .swal2-modal .swal2-content {
            font-size: 18px;
            text-align: center;
            font-weight: 300;
            position: relative;
            float: none;
            margin: 0;
            padding: 0;
            line-height: normal;
            color: #545454;
            word-wrap: break-word;
        }

        .swal2-modal .swal2-input,
        .swal2-modal .swal2-file,
        .swal2-modal .swal2-textarea,
        .swal2-modal .swal2-select,
        .swal2-modal .swal2-radio,
        .swal2-modal .swal2-checkbox {
            margin: 20px auto;
        }

        .swal2-modal .swal2-input,
        .swal2-modal .swal2-file,
        .swal2-modal .swal2-textarea {
            width: 100%;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            font-size: 18px;
            border-radius: 3px;
            border: 1px solid #d9d9d9;
            -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.06);
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.06);
            -webkit-transition: border-color .3s, -webkit-box-shadow .3s;
            transition: border-color .3s, -webkit-box-shadow .3s;
            transition: border-color .3s, box-shadow .3s;
            transition: border-color .3s, box-shadow .3s, -webkit-box-shadow .3s;
        }

        .swal2-modal .swal2-input.swal2-inputerror,
        .swal2-modal .swal2-file.swal2-inputerror,
        .swal2-modal .swal2-textarea.swal2-inputerror {
            border-color: #f27474 !important;
            -webkit-box-shadow: 0 0 2px #f27474 !important;
            box-shadow: 0 0 2px #f27474 !important;
        }

        .swal2-modal .swal2-input:focus,
        .swal2-modal .swal2-file:focus,
        .swal2-modal .swal2-textarea:focus {
            outline: none;
            border: 1px solid #b4dbed;
            -webkit-box-shadow: 0 0 3px #c4e6f5;
            box-shadow: 0 0 3px #c4e6f5;
        }

        .swal2-modal .swal2-input::-webkit-input-placeholder,
        .swal2-modal .swal2-file::-webkit-input-placeholder,
        .swal2-modal .swal2-textarea::-webkit-input-placeholder {
            color: #cccccc;
        }

        .swal2-modal .swal2-input:-ms-input-placeholder,
        .swal2-modal .swal2-file:-ms-input-placeholder,
        .swal2-modal .swal2-textarea:-ms-input-placeholder {
            color: #cccccc;
        }

        .swal2-modal .swal2-input::-ms-input-placeholder,
        .swal2-modal .swal2-file::-ms-input-placeholder,
        .swal2-modal .swal2-textarea::-ms-input-placeholder {
            color: #cccccc;
        }

        .swal2-modal .swal2-input::placeholder,
        .swal2-modal .swal2-file::placeholder,
        .swal2-modal .swal2-textarea::placeholder {
            color: #cccccc;
        }

        .swal2-modal .swal2-range input {
            float: left;
            width: 80%;
        }

        .swal2-modal .swal2-range output {
            float: right;
            width: 20%;
            font-size: 20px;
            font-weight: 600;
            text-align: center;
        }

        .swal2-modal .swal2-range input,
        .swal2-modal .swal2-range output {
            height: 43px;
            line-height: 43px;
            vertical-align: middle;
            margin: 20px auto;
            padding: 0;
        }

        .swal2-modal .swal2-input {
            height: 43px;
            padding: 0 12px;
        }

        .swal2-modal .swal2-input[type='number'] {
            max-width: 150px;
        }

        .swal2-modal .swal2-file {
            font-size: 20px;
        }

        .swal2-modal .swal2-textarea {
            height: 108px;
            padding: 12px;
        }

        .swal2-modal .swal2-select {
            color: #545454;
            font-size: inherit;
            padding: 5px 10px;
            min-width: 40%;
            max-width: 100%;
        }

        .swal2-modal .swal2-radio {
            border: 0;
        }

        .swal2-modal .swal2-radio label:not(:first-child) {
            margin-left: 20px;
        }

        .swal2-modal .swal2-radio input,
        .swal2-modal .swal2-radio span {
            vertical-align: middle;
        }

        .swal2-modal .swal2-radio input {
            margin: 0 3px 0 0;
        }

        .swal2-modal .swal2-checkbox {
            color: #545454;
        }

        .swal2-modal .swal2-checkbox input,
        .swal2-modal .swal2-checkbox span {
            vertical-align: middle;
        }

        .swal2-modal .swal2-validationerror {
            background-color: #f0f0f0;
            margin: 0 -20px;
            overflow: hidden;
            padding: 10px;
            color: gray;
            font-size: 16px;
            font-weight: 300;
            display: none;
        }

        .swal2-modal .swal2-validationerror::before {
            content: '!';
            display: inline-block;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background-color: #ea7d7d;
            color: #fff;
            line-height: 24px;
            text-align: center;
            margin-right: 10px;
        }

        @supports (-ms-accelerator: true) {
            .swal2-range input {
                width: 100% !important;
            }

            .swal2-range output {
                display: none;
            }
        }

        @media all and (-ms-high-contrast: none),
        (-ms-high-contrast: active) {
            .swal2-range input {
                width: 100% !important;
            }

            .swal2-range output {
                display: none;
            }
        }

        .swal2-icon {
            width: 80px;
            height: 80px;
            border: 4px solid transparent;
            border-radius: 50%;
            margin: 20px auto 30px;
            padding: 0;
            position: relative;
            -webkit-box-sizing: content-box;
            box-sizing: content-box;
            cursor: default;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .swal2-icon.swal2-error {
            border-color: #f27474;
        }

        .swal2-icon.swal2-error .swal2-x-mark {
            position: relative;
            display: block;
        }

        .swal2-icon.swal2-error [class^='swal2-x-mark-line'] {
            position: absolute;
            height: 5px;
            width: 47px;
            background-color: #f27474;
            display: block;
            top: 37px;
            border-radius: 2px;
        }

        .swal2-icon.swal2-error [class^='swal2-x-mark-line'][class$='left'] {
            -webkit-transform: rotate(45deg);
            transform: rotate(45deg);
            left: 17px;
        }

        .swal2-icon.swal2-error [class^='swal2-x-mark-line'][class$='right'] {
            -webkit-transform: rotate(-45deg);
            transform: rotate(-45deg);
            right: 16px;
        }

        .swal2-icon.swal2-warning {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #f8bb86;
            border-color: #facea8;
            font-size: 60px;
            line-height: 80px;
            text-align: center;
        }

        .swal2-icon.swal2-info {
            font-family: 'Open Sans', sans-serif;
            color: #3fc3ee;
            border-color: #9de0f6;
            font-size: 60px;
            line-height: 80px;
            text-align: center;
        }

        .swal2-icon.swal2-question {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #87adbd;
            border-color: #c9dae1;
            font-size: 60px;
            line-height: 80px;
            text-align: center;
        }

        .swal2-icon.swal2-success {
            border-color: #a5dc86;
        }

        .swal2-icon.swal2-success [class^='swal2-success-circular-line'] {
            border-radius: 50%;
            position: absolute;
            width: 60px;
            height: 120px;
            -webkit-transform: rotate(45deg);
            transform: rotate(45deg);
        }

        .swal2-icon.swal2-success [class^='swal2-success-circular-line'][class$='left'] {
            border-radius: 120px 0 0 120px;
            top: -7px;
            left: -33px;
            -webkit-transform: rotate(-45deg);
            transform: rotate(-45deg);
            -webkit-transform-origin: 60px 60px;
            transform-origin: 60px 60px;
        }

        .swal2-icon.swal2-success [class^='swal2-success-circular-line'][class$='right'] {
            border-radius: 0 120px 120px 0;
            top: -11px;
            left: 30px;
            -webkit-transform: rotate(-45deg);
            transform: rotate(-45deg);
            -webkit-transform-origin: 0 60px;
            transform-origin: 0 60px;
        }

        .swal2-icon.swal2-success .swal2-success-ring {
            width: 80px;
            height: 80px;
            border: 4px solid rgba(165, 220, 134, 0.2);
            border-radius: 50%;
            -webkit-box-sizing: content-box;
            box-sizing: content-box;
            position: absolute;
            left: -4px;
            top: -4px;
            z-index: 2;
        }

        .swal2-icon.swal2-success .swal2-success-fix {
            width: 7px;
            height: 90px;
            position: absolute;
            left: 28px;
            top: 8px;
            z-index: 1;
            -webkit-transform: rotate(-45deg);
            transform: rotate(-45deg);
        }

        .swal2-icon.swal2-success [class^='swal2-success-line'] {
            height: 5px;
            background-color: #a5dc86;
            display: block;
            border-radius: 2px;
            position: absolute;
            z-index: 2;
        }

        .swal2-icon.swal2-success [class^='swal2-success-line'][class$='tip'] {
            width: 25px;
            left: 14px;
            top: 46px;
            -webkit-transform: rotate(45deg);
            transform: rotate(45deg);
        }

        .swal2-icon.swal2-success [class^='swal2-success-line'][class$='long'] {
            width: 47px;
            right: 8px;
            top: 38px;
            -webkit-transform: rotate(-45deg);
            transform: rotate(-45deg);
        }

        .swal2-progresssteps {
            font-weight: 600;
            margin: 0 0 20px;
            padding: 0;
        }

        .swal2-progresssteps li {
            display: inline-block;
            position: relative;
        }

        .swal2-progresssteps .swal2-progresscircle {
            background: #3085d6;
            border-radius: 2em;
            color: #fff;
            height: 2em;
            line-height: 2em;
            text-align: center;
            width: 2em;
            z-index: 20;
        }

        .swal2-progresssteps .swal2-progresscircle:first-child {
            margin-left: 0;
        }

        .swal2-progresssteps .swal2-progresscircle:last-child {
            margin-right: 0;
        }

        .swal2-progresssteps .swal2-progresscircle.swal2-activeprogressstep {
            background: #3085d6;
        }

        .swal2-progresssteps .swal2-progresscircle.swal2-activeprogressstep~.swal2-progresscircle {
            background: #add8e6;
        }

        .swal2-progresssteps .swal2-progresscircle.swal2-activeprogressstep~.swal2-progressline {
            background: #add8e6;
        }

        .swal2-progresssteps .swal2-progressline {
            background: #3085d6;
            height: .4em;
            margin: 0 -1px;
            z-index: 10;
        }

        [class^='swal2'] {
            -webkit-tap-highlight-color: transparent;
        }

        @-webkit-keyframes showSweetAlert {
            0% {
                -webkit-transform: scale(0.7);
                transform: scale(0.7);
            }

            45% {
                -webkit-transform: scale(1.05);
                transform: scale(1.05);
            }

            80% {
                -webkit-transform: scale(0.95);
                transform: scale(0.95);
            }

            100% {
                -webkit-transform: scale(1);
                transform: scale(1);
            }
        }

        @keyframes showSweetAlert {
            0% {
                -webkit-transform: scale(0.7);
                transform: scale(0.7);
            }

            45% {
                -webkit-transform: scale(1.05);
                transform: scale(1.05);
            }

            80% {
                -webkit-transform: scale(0.95);
                transform: scale(0.95);
            }

            100% {
                -webkit-transform: scale(1);
                transform: scale(1);
            }
        }

        @-webkit-keyframes hideSweetAlert {
            0% {
                -webkit-transform: scale(1);
                transform: scale(1);
                opacity: 1;
            }

            100% {
                -webkit-transform: scale(0.5);
                transform: scale(0.5);
                opacity: 0;
            }
        }

        @keyframes hideSweetAlert {
            0% {
                -webkit-transform: scale(1);
                transform: scale(1);
                opacity: 1;
            }

            100% {
                -webkit-transform: scale(0.5);
                transform: scale(0.5);
                opacity: 0;
            }
        }

        .swal2-show {
            -webkit-animation: showSweetAlert .3s;
            animation: showSweetAlert .3s;
        }

        .swal2-show.swal2-noanimation {
            -webkit-animation: none;
            animation: none;
        }

        .swal2-hide {
            -webkit-animation: hideSweetAlert .15s forwards;
            animation: hideSweetAlert .15s forwards;
        }

        .swal2-hide.swal2-noanimation {
            -webkit-animation: none;
            animation: none;
        }

        @-webkit-keyframes animate-success-tip {
            0% {
                width: 0;
                left: 1px;
                top: 19px;
            }

            54% {
                width: 0;
                left: 1px;
                top: 19px;
            }

            70% {
                width: 50px;
                left: -8px;
                top: 37px;
            }

            84% {
                width: 17px;
                left: 21px;
                top: 48px;
            }

            100% {
                width: 25px;
                left: 14px;
                top: 45px;
            }
        }

        @keyframes animate-success-tip {
            0% {
                width: 0;
                left: 1px;
                top: 19px;
            }

            54% {
                width: 0;
                left: 1px;
                top: 19px;
            }

            70% {
                width: 50px;
                left: -8px;
                top: 37px;
            }

            84% {
                width: 17px;
                left: 21px;
                top: 48px;
            }

            100% {
                width: 25px;
                left: 14px;
                top: 45px;
            }
        }

        @-webkit-keyframes animate-success-long {
            0% {
                width: 0;
                right: 46px;
                top: 54px;
            }

            65% {
                width: 0;
                right: 46px;
                top: 54px;
            }

            84% {
                width: 55px;
                right: 0;
                top: 35px;
            }

            100% {
                width: 47px;
                right: 8px;
                top: 38px;
            }
        }

        @keyframes animate-success-long {
            0% {
                width: 0;
                right: 46px;
                top: 54px;
            }

            65% {
                width: 0;
                right: 46px;
                top: 54px;
            }

            84% {
                width: 55px;
                right: 0;
                top: 35px;
            }

            100% {
                width: 47px;
                right: 8px;
                top: 38px;
            }
        }

        @-webkit-keyframes rotatePlaceholder {
            0% {
                -webkit-transform: rotate(-45deg);
                transform: rotate(-45deg);
            }

            5% {
                -webkit-transform: rotate(-45deg);
                transform: rotate(-45deg);
            }

            12% {
                -webkit-transform: rotate(-405deg);
                transform: rotate(-405deg);
            }

            100% {
                -webkit-transform: rotate(-405deg);
                transform: rotate(-405deg);
            }
        }

        @keyframes rotatePlaceholder {
            0% {
                -webkit-transform: rotate(-45deg);
                transform: rotate(-45deg);
            }

            5% {
                -webkit-transform: rotate(-45deg);
                transform: rotate(-45deg);
            }

            12% {
                -webkit-transform: rotate(-405deg);
                transform: rotate(-405deg);
            }

            100% {
                -webkit-transform: rotate(-405deg);
                transform: rotate(-405deg);
            }
        }

        .swal2-animate-success-line-tip {
            -webkit-animation: animate-success-tip .75s;
            animation: animate-success-tip .75s;
        }

        .swal2-animate-success-line-long {
            -webkit-animation: animate-success-long .75s;
            animation: animate-success-long .75s;
        }

        .swal2-success.swal2-animate-success-icon .swal2-success-circular-line-right {
            -webkit-animation: rotatePlaceholder 4.25s ease-in;
            animation: rotatePlaceholder 4.25s ease-in;
        }

        @-webkit-keyframes animate-error-icon {
            0% {
                -webkit-transform: rotateX(100deg);
                transform: rotateX(100deg);
                opacity: 0;
            }

            100% {
                -webkit-transform: rotateX(0deg);
                transform: rotateX(0deg);
                opacity: 1;
            }
        }

        @keyframes animate-error-icon {
            0% {
                -webkit-transform: rotateX(100deg);
                transform: rotateX(100deg);
                opacity: 0;
            }

            100% {
                -webkit-transform: rotateX(0deg);
                transform: rotateX(0deg);
                opacity: 1;
            }
        }

        .swal2-animate-error-icon {
            -webkit-animation: animate-error-icon .5s;
            animation: animate-error-icon .5s;
        }

        @-webkit-keyframes animate-x-mark {
            0% {
                -webkit-transform: scale(0.4);
                transform: scale(0.4);
                margin-top: 26px;
                opacity: 0;
            }

            50% {
                -webkit-transform: scale(0.4);
                transform: scale(0.4);
                margin-top: 26px;
                opacity: 0;
            }

            80% {
                -webkit-transform: scale(1.15);
                transform: scale(1.15);
                margin-top: -6px;
            }

            100% {
                -webkit-transform: scale(1);
                transform: scale(1);
                margin-top: 0;
                opacity: 1;
            }
        }

        @keyframes animate-x-mark {
            0% {
                -webkit-transform: scale(0.4);
                transform: scale(0.4);
                margin-top: 26px;
                opacity: 0;
            }

            50% {
                -webkit-transform: scale(0.4);
                transform: scale(0.4);
                margin-top: 26px;
                opacity: 0;
            }

            80% {
                -webkit-transform: scale(1.15);
                transform: scale(1.15);
                margin-top: -6px;
            }

            100% {
                -webkit-transform: scale(1);
                transform: scale(1);
                margin-top: 0;
                opacity: 1;
            }
        }

        .swal2-animate-x-mark {
            -webkit-animation: animate-x-mark .5s;
            animation: animate-x-mark .5s;
        }

        @-webkit-keyframes rotate-loading {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @keyframes rotate-loading {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

    </style>
</head>


<body>
    <div class="spinner" style="display: none;">
        <p class="image">
            <img height="50" src="https://netpos.gapi.lol/img/cashier-white/img/logo.png">
        </p>
        <div class="bounce1"></div>
        <div class="bounce2"></div>
        <div class="bounce3"></div>
    </div>
    <div class="spinner2" style="display: none;">
        <p class="image">
            <img height="50" src="https://netpos.gapi.lol/img/cashier-white/img/logo.png">
        </p>
        <div class="bounce1"></div>
        <div class="bounce2"></div>
        <div class="bounce3"></div>
    </div>

   
    <div class="all-wrapper menu-side with-side-panel">
        <div class="layout-w">
        @include("backend.newBackend.partials.shopSidebar")
            <div class="content-w">
                @yield('content')

</div>
        </div>
        <div class="display-type text-right"></div>
    </div>
   
                



                @include('backend.newbackend.partials.modals')




                <script src="https://cdnjs.cloudflare.com/ajax/libs/timeago.js/2.0.2/timeago.min.js" integrity="sha512-sl01o/gVwybF1FNzqO4NDRDNPJDupfN0o2+tMm4K2/nr35FjGlxlvXZ6kK6faa9zhXbnfLIXioHnExuwJdlTMA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>
