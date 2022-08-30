<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Agent Panel</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>

    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
      
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css?v=3.2.0') }}">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    
    <style>
      @import url("https://fonts.googleapis.com/css?family=Red+Hat+Display:400,500,900&display=swap");
      body, html {
        font-family: Red hat Display, sans-serif;
        font-weight: 400;
        line-height: 1.25em;
        letter-spacing: 0.025em;
        color: #333;
        background: #F7F7F7;
      }

      .center {
        position: absolute;
        top: 49%;
        left: calc(50% + 15rem);
        transform: translate(-49%, -50%);
      }

      .pic {
        width: 4rem;
        height: 4rem;
        background-size: cover;
        background-position: center;
        border-radius: 50%;
      }

      .contact {
        position: relative;
        margin-bottom: 1rem;
        padding-left: 5rem;
        height: 4.5rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
      }
      .contact .pic {
        position: absolute;
        left: 0;
      }
      .contact .name {
        font-weight: 500;
        margin-bottom: 0.125rem;
      }
      .contact .message, .contact .seen {
        font-size: 0.9rem;
        color: #999;
      }
      .contact .badge {
        box-sizing: border-box;
        position: absolute;
        width: 1.5rem;
        height: 1.5rem;
        text-align: center;
        font-size: 0.9rem;
        padding-top: 0.125rem;
        border-radius: 1rem;
        top: 0;
        left: 2.5rem;
        background: #333;
        color: white;
      }

      .contacts { 
        margin-top: -78px;
        position: absolute;
        top: 60%;
        left: 0;
        transform: translate(-23rem, -50%);
        width: 23rem;
        height: 48rem;
        padding: 1rem 2rem 1rem 1rem;
        box-sizing: border-box;
        border-radius: 1rem 0 0 1rem;
        cursor: pointer;
        background: white;
        box-shadow: 0 0 8rem 0 rgba(0, 0, 0, 0.1), 2rem 2rem 4rem -3rem rgba(0, 0, 0, 0.5);
        transition: transform 500ms;
      }
      .contacts h2 {
        margin: 0.5rem 0 1.5rem 5rem;
      }
      .contacts .fa-bars {
        position: absolute;
        left: 2.25rem;
        color: #999;
        transition: color 200ms;
      }
      .contacts .fa-bars:hover {
        color: #666;
      }
      .contacts .contact:last-child {
        margin: 0;
      }
      .contacts:hover {
        transform: translate(-23rem, -50%);
      }

      .chat {
        margin-bottom: 95px;
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: right;
        width: 61rem;
        height: 43rem;
        z-index: 2;
        box-sizing: border-box;
        border-radius: 1rem;
        background: white;
        box-shadow: 0 0 8rem 0 rgba(0, 0, 0, 0.1), 0rem 2rem 4rem -3rem rgba(0, 0, 0, 0.5);
      }
      .chat .contact.bar {
        flex-basis: 3.5rem;
        flex-shrink: 0;
        margin: 1rem;
        box-sizing: border-box;
      }
      .chat .messages {
        min-height: -webkit-fill-available;
        padding: 1rem;
        background: #F7F7F7;
        flex-shrink: 2;
        overflow-y: auto;
        box-shadow: inset 0 2rem 2rem -2rem rgba(0, 0, 0, 0.05), inset 0 -2rem 2rem -2rem rgba(0, 0, 0, 0.05);
      }
      .chat .messages .time {
        font-size: 0.8rem;
        background: #EEE;
        padding: 0.25rem 1rem;
        border-radius: 2rem;
        color: #999;
        width: -webkit-fit-content;
        width: -moz-fit-content;
        width: fit-content;
        margin: 0 auto;
      }
      .chat .messages .message {
        box-sizing: border-box;
        padding: 0.5rem 1rem;
        margin: 1rem;
        background: #FFF;
        border-radius: 1.125rem 1.125rem 1.125rem 0;
        min-height: 2.25rem;
        width: -webkit-fit-content;
        width: -moz-fit-content;
        width: fit-content;
        max-width: 66%;
        box-shadow: 0 0 2rem rgba(0, 0, 0, 0.075), 0rem 1rem 1rem -1rem rgba(0, 0, 0, 0.1);
      }
      .chat .messages .message.send {
        margin: 3rem 1rem 1rem auto;
        border-radius: 1.125rem 1.125rem 0 1.125rem;
        background: #333;
        color: white;
      }


      .time-send{
        float:right;
      }



      .chat .messages .message .typing {
        display: inline-block;
        width: 0.8rem;
        height: 0.8rem;
        margin-right: 0rem;
        box-sizing: border-box;
        background: #ccc;
        border-radius: 50%;
      }
      .chat .messages .message .typing.typing-1 {
        -webkit-animation: typing 3s infinite;
                animation: typing 3s infinite;
      }
      .chat .messages .message .typing.typing-2 {
        -webkit-animation: typing 3s 250ms infinite;
                animation: typing 3s 250ms infinite;
      }
      .chat .messages .message .typing.typing-3 {
        -webkit-animation: typing 3s 500ms infinite;
                animation: typing 3s 500ms infinite;
      }
      .chat .input {
        box-sizing: border-box;
        flex-basis: 4rem;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        padding: 0 0.5rem 0 1.5rem;
      }
      .chat .input i {
        font-size: 1.5rem;
        margin-right: 1rem;
        color: #666;
        cursor: pointer;
        transition: color 200ms;
      }
      .chat .input i:hover {
        color: #333;
      }
      .chat .input input {
        border: none;
        background-image: none;
        background-color: white;
        padding: 0.5rem 1rem;
        margin-right: 1rem;
        border-radius: 1.125rem;
        flex-grow: 2;
        box-shadow: 0 0 1rem rgba(0, 0, 0, 0.1), 0rem 1rem 1rem -1rem rgba(0, 0, 0, 0.2);
        font-family: Red hat Display, sans-serif;
        font-weight: 400;
        letter-spacing: 0.025em;
      }
      .chat .input input:placeholder {
        color: #999;
      }

      @-webkit-keyframes typing {
        0%, 75%, 100% {
          transform: translate(0, 0.25rem) scale(0.9);
          opacity: 0.5;
        }
        25% {
          transform: translate(0, -0.25rem) scale(1);
          opacity: 1;
        }
      }

      @keyframes typing {
        0%, 75%, 100% {
          transform: translate(0, 0.25rem) scale(0.9);
          opacity: 0.5;
        }
        25% {
          transform: translate(0, -0.25rem) scale(1);
          opacity: 1;
        }
      }
      .pic.stark {
        background-image: url("https://vignette.wikia.nocookie.net/marvelcinematicuniverse/images/7/73/SMH_Mentor_6.png");
      }

      .pic.banner {
        background-image: url("https://vignette.wikia.nocookie.net/marvelcinematicuniverse/images/7/73/SMH_Mentor_6.png");
      }

      .pic.thor {
        background-image: url("https://vignette.wikia.nocookie.net/marvelcinematicuniverse/images/7/73/SMH_Mentor_6.png");
      }

      .pic.danvers {
        background-image: url("https://vignette.wikia.nocookie.net/marvelcinematicuniverse/images/7/73/SMH_Mentor_6.png");
      }

      .pic.rogers {
        background-image: url("https://vignette.wikia.nocookie.net/marvelcinematicuniverse/images/7/73/SMH_Mentor_6.png");
      }
    </style>


  </head>
  <body class="hold-transition sidebar-mini body" id="scroll" style="overflow-x:hidden;">
    <div class="wrapper">

      @include('layoutsAgent.header')
      @include('layoutsAgent.sidebar')
      @yield('content')
      @include('layoutsAgent.footer')

    </div>

  </body>
</html>