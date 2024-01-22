<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 
    <!-- The CSS stylesheet which will be inlined. -->
    @vite('resources/css/app.css')
</head>
<body>
<section class="max-w-2xl px-6 py-8 mx-auto bg-white dark:bg-gray-900">
    <main class="mt-8">
        <p class="my-4 leading-loose text-gray-600 dark:text-gray-300">
           {!! $content !!}
        </p>
    </main>
    

    <footer class="mt-8">
        <p class="mt-3 text-gray-500 dark:text-gray-400">© {{ date('Y') }} Real People CRM. All Rights Reserved. Made with 🖤 in Altanta</p>
    </footer>
</section>    
</body>
</html>