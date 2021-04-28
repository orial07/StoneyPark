<!doctype html>
<title>Site Maintenance</title>
<style>
    body {
        font: 20px Helvetica, sans-serif;
        color: #fff;
        background: #2e2e2e;
        text-align: center;
        padding: 150px;
    }

    h1 {
        font-size: 50px;
    }

    article {
        display: block;
        text-align: left;
        width: 650px;
        margin: 0 auto;
    }

    a {
        color: #dc8100;
        text-decoration: none;
    }

    a:hover {
        color: #333;
        text-decoration: none;
    }

    object {
        width: 1em;
        vertical-align: middle;
    }

</style>

<article>
    <h1><object class="mx-auto display-1" data="{{ asset('img/sad.svg') }}"></object> We&rsquo;ll be back soon!</h1>
    <div>
        <p>Sorry for the inconvenience but the site is under maintenance at the moment. If you need to, you can always
            <a href="mailto:{{ config('mail.to.address') }}">contact us</a>, otherwise we&rsquo;ll be back online
            shortly!
        </p>
    </div>
</article>
