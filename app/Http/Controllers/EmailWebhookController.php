<?php

namespace App\Http\Controllers;

use App\Actions\ContactEvents\CreateOrUpdateContactEvent;
use App\Actions\Contacts\CreateOrUpdateContact;
use App\Models\ContactMethod;
use App\Services\EmailProcessingService;
use Illuminate\Http\Request;

class EmailWebhookController extends Controller
{
    public function __construct()
    {
    }

    public function handle(Request $request)
    {
        // Handle the incoming email webhook
        $email = new EmailProcessingService($request->all());

        // Email received from a contact and forwarded to app
        if ($email->isForward()) {
            $contactInfo = $email->getOriginalSender();
        } else { // Email sent to a contact and received by app as cc/bcc
            $contactInfo = $email->getRecipient();
        }
        $contactInfo = [...$contactInfo, 'user_id' => $email->getSenderUser()->id];
        $newContact = app(CreateOrUpdateContact::class)($contactInfo);

        $newContact->ContactEvents()->create([
            'id' => $newContact['id'],
            'user_id' => $email->getSenderUser()->id,
            'title' => $email->wasReceived() ? $newContact['first_name'] . ' to ' . $email->getSenderUser()->name : $email->getSenderUser()->name . ' to ' . $newContact['first_name'],
            'date' => $email->getDate(),
            'contact_method_id' => ContactMethod::where('name', 'Email')->first()?->id,
            'recap' => '',
        ]);

        // 'id' => $this->contact_event?->id,
        //     'user_id' => auth()->id(),
        //     'title' => $this->title,
        //     'description' => $this->description,
        //     'date' => $this->date,
        //     'location' => $this->location,
        //     'contact_id' => $this->contact->id,
        //     'contact_method_id' => $this->contact_method_id,
        //     'recap' => $this->recap,
        //$newContactEvent = app(CreateOrUpdateContactEvent::class)($newContact);

        return response('OK', 200)->header('Content-Type', 'text/plain');
    }

    public function sentByUser(Request $request)
    {

    }
}

/*
FORWARDED EMAIL

[
    'Content-Type' => 'multipart/alternative; boundary=\"65d8c1c2_9fe2bec_15532\"',
    'Date' => 'Fri, 23 Feb 2024 11:03:09 -0500',
    'Dkim-Signature' => 'v=1; a=rsa-sha256; c=relaxed/relaxed; d=gmail.com; s=20230601; t=1708704197; x=1709308997; darn=app.realpeoplecrm.com; h=mime-version:subject:references:in-reply-to:message-id:to:from:date :from:to:cc:subject:date:message-id:reply-to; bh=fD6yOWzun+uWZRFdIhrRXuTEbgcUdjMb6quHm2zv0MI=; b=ElHI7lpgTdwRH4gCq6VYSDzycprdq+Gw6gZ4WY1FWeIrZsrJsWLQFY6gE/R9DtlMRe uv/LpWgZvVN+gFjSujX2S4OmtMY/7PTOcCNW6DWDyBiucsdt64yVPkmAkm3owdDAnEaU smOkcIiAUTqLLrawae7uNiZlFSXToO83NzVHAprUZO6+dQ4ocdZlNTz7cUoGX1PG4hQQ OQ8280MZeWfZrG9IqRSnc88IjAdYjiGxYEAlSvJce+XISWKA0u3g17Lomdn0IX4t8Fnj 9IPiw5o5ISHAtqPdYp3oLpz0JD6GUteNaQAFfpZK4magO0ny5XcCN4v2MjNzraWDvorf FTuQ==',
    'From' => 'Nic Rosental <nicrosental@gmail.com>',
    'In-Reply-To' => '<CAD+BDRHcJgES3WiXCo5-7d48HFObFTquaWKcJH9hHZ28wYCrmg@mail.gmail.com>',
    'Message-Id' => '<00a67994-93d4-4952-b544-62f5e189c6d7@Spark>',
    'Mime-Version' => '1.0',
    'Received' => 'from [10.103.230.43] ([50.168.171.166]) by smtp.gmail.com with ESMTPSA id v192-20020a252fc9000000b00dc74efa1bb4sm3413712ybv.13.2024.02.23.08.03.15 for <updates@app.realpeoplecrm.com> (version=TLS1_2 cipher=ECDHE-ECDSA-AES128-GCM-SHA256 bits=128/128); Fri, 23 Feb 2024 08:03:16 -0800 (PST)',
    'References' => '<c7b274b3-44aa-4601-9d47-1946e4a3744c@Spark> <CAD+BDRHcJgES3WiXCo5-7d48HFObFTquaWKcJH9hHZ28wYCrmg@mail.gmail.com>',
    'Return-Path' => '<nicrosental@gmail.com>',
    'Subject' => 'Fwd: Re: Follow up',
    'To' => 'updates@app.realpeoplecrm.com',
    'X-Envelope-From' => 'nicrosental@gmail.com',
    'X-Gm-Message-State' => 'AOJu0YzT7mtI6FmmLY0xNFe+rTnS8d8lyPNXQL/uCZs+wNApYOec4c7o 7Xl/6uNlqi/5u3zwUr206oO67/cqAXD1YA4QGzccBNOimSZhsG5RTnJI1ciXiRs=',
    'X-Google-Dkim-Signature' => 'v=1; a=rsa-sha256; c=relaxed/relaxed; d=1e100.net; s=20230601; t=1708704197; x=1709308997; h=mime-version:subject:references:in-reply-to:message-id:to:from:date :x-gm-message-state:from:to:cc:subject:date:message-id:reply-to; bh=fD6yOWzun+uWZRFdIhrRXuTEbgcUdjMb6quHm2zv0MI=; b=PnBqm1ztWEeQH3Uzoyx/MpYNQmwWJGy1/qv+BWXOQ+vNH/mkwBEjyq5TtU7hri6moF yz4DvMZsOeskkZYn2uMNsukb8yXB34d6byT+fsOJx1cmLrL17XDKlt9ujYLlyIJvt0H+ Iwp9Yzp06RRILh+HGyyzXa6FA10sR2OnwfuKIoZbhYIpQlp8/wOuzyPE1o27Grux3xfI aLKIeH1MRlleCMr780c6xz9lUzKJWshI4VvheiYRH8a+/NSm/jBZ0rVPsBdYqDmt54Jo WaDrRrj/LggXUzVke4FH6MtmnFKhHu51NQQsHakG8+tZ3jlPDIoWLoCN6DyQfBOtbliQ A5CQ==',
    'X-Google-Smtp-Source' => 'AGHT+IEQ3nNrkv78lXj6sgdSd38cMkjjmVdsS8Cheze9fPUj6R6P34HtfqfgP+f1v+EY+Ri+Jbg0hw==',
    'X-Mailgun-Incoming' => 'Yes',
    'X-Readdle-Message-Id' => '00a67994-93d4-4952-b544-62f5e189c6d7@Spark',
    'X-Received' => 'by 2002:a25:ce02:0:b0:dc7:491a:18c2 with SMTP id x2-20020a25ce02000000b00dc7491a18c2mr154322ybe.6.1708704196379; Fri, 23 Feb 2024 08:03:16 -0800 (PST)',
    'body-html' => '<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
<title></title>
</head>
<body>
<div name=\"messageSignatureSection\"><br />
<div dir=\"auto\"><span style=\"color:#000000;background-color:#ffffff;font-family:sans-serif;font-size: 14px\">Nic&#160;Rosental</span><span style=\"font-size: 14px\"><br /></span><a style=\"background-color:#ffffff;font-family:sans-serif;font-size: 14px\" href=\"https://nicrosental.com/\" target=\"_blank\">nicrosental.com</a><span style=\"font-size: 14px\"><br /></span><a style=\"background-color:#ffffff;font-family:sans-serif;font-size: 14px\" href=\"https://linkedin.com/in/rosental\" target=\"_blank\">LinkedIn</a><span style=\"font-size: 14px\"><br /></span></div>
</div>
<div name=\"messageReplySection\">---------- Forwarded message ----------<br />
<b>From:</b> Kristin Slink &lt;kristin@iamtechaf.com&gt;<br />
<b>Date:</b> Feb 23, 2024 at 10:54 AM -0500<br />
<b>To:</b> Nic Rosental &lt;nicrosental@gmail.com&gt;<br />
<b>Subject:</b> Re: Follow up<br />
<br />
<blockquote type=\"cite\">
<div dir=\"ltr\">Thank you for your time today Nic! I\'m looking forward&#160;to the Fractionals United group and will pass along your information&#160;to any founders I run into looking for some technical expertise and support.
<div><br /></div>
<div>Kristin</div>
</div>
<br />
<div class=\"gmail_quote\">
<div dir=\"ltr\" class=\"gmail_attr\">On Fri, Feb 23, 2024 at 10:28 AM Nic Rosental &lt;<a href=\"mailto:nicrosental@gmail.com\">nicrosental@gmail.com</a>&gt; wrote:<br /></div>
<blockquote class=\"gmail_quote\" style=\"margin:0px 0px 0px 0.8ex;border-left:1px solid rgb(204,204,204);padding-left:1ex\">
<div>
<div name=\"messageBodySection\">
<div dir=\"auto\">Hi Kristin,<br />
<br />
It was great chatting with you. I already put in the request for you to get an invite to Fractionals United, please let me know if you don\'t get one in the next few days. My services can be found on&#160;<a href=\"https://nicrosental.com/\" target=\"_blank\">my website</a>&#160;and I will send the one-pager as soon as I have it ready.<br />
<br />
I\'m looking forward to meeting you in person soon.<br />
<br />
Best,</div>
</div>
<div name=\"messageSignatureSection\"><br />
<div dir=\"auto\"><span style=\"color:rgb(0,0,0);background-color:rgb(255,255,255);font-family:sans-serif;font-size:14px\">Nic&#160;Rosental</span><span style=\"font-size:14px\"><br /></span><a style=\"background-color:rgb(255,255,255);font-family:sans-serif;font-size:14px\" href=\"https://nicrosental.com/\" target=\"_blank\">nicrosental.com</a><span style=\"font-size:14px\"><br /></span><a style=\"background-color:rgb(255,255,255);font-family:sans-serif;font-size:14px\" href=\"https://linkedin.com/in/rosental\" target=\"_blank\">LinkedIn</a><span style=\"font-size:14px\"><br /></span></div>
</div>
</div>
</blockquote>
</div>
<br clear=\"all\" />
<div><br /></div>
<span class=\"gmail_signature_prefix\">--</span><br />
<div dir=\"ltr\" class=\"gmail_signature\">
<div dir=\"ltr\"><img src=\"https://ci3.googleusercontent.com/mail-sig/AIorK4yfCn72_s8gapa6o-cg33uPSfrxPDL1JSlWFnk-m5VWltO60mnm9VgUFBhxJ2MKdrFkIpKm07M\" /><br />
<div><a href=\"https://www.iamtechaf.com/your-startup-tech-advisor\" target=\"_blank\">Tech Advisory Packages</a><br /></div>
<div><a href=\"https://www.iamtechaf.com/supporterscontributetoequity\" target=\"_blank\">Sponsor Women Founders</a><br /></div>
<div><br /></div>
<div><br /></div>
</div>
</div>
</blockquote>
</div>
</body>
</html>',
    'body-plain' => 'Nic Rosental
nicrosental.com
LinkedIn
---------- Forwarded message ----------
From: Kristin Slink <kristin@iamtechaf.com>
Date: Feb 23, 2024 at 10:54 AM -0500
To: Nic Rosental <nicrosental@gmail.com>
Subject: Re: Follow up

> Thank you for your time today Nic! I\'m looking forward to the Fractionals United group and will pass along your information to any founders I run into looking for some technical expertise and support.
>
> Kristin
>
> > On Fri, Feb 23, 2024 at 10:28 AM Nic Rosental <nicrosental@gmail.com> wrote:
> > > Hi Kristin,
> > >
> > > It was great chatting with you. I already put in the request for you to get an invite to Fractionals United, please let me know if you don\'t get one in the next few days. My services can be found on my website and I will send the one-pager as soon as I have it ready.
> > >
> > > I\'m looking forward to meeting you in person soon.
> > >
> > > Best,
> > >
> > > Nic Rosental
> > > nicrosental.com
> > > LinkedIn
>
>
> --
>
> Tech Advisory Packages
> Sponsor Women Founders
>
>',
    'from' => 'Nic Rosental <nicrosental@gmail.com>',
    'message-headers' => '[[\"Received\",\"from mail-yb1-f170.google.com (mail-yb1-f170.google.com [209.85.219.170]) by 8cc6c369e3d4 with SMTP id <undefined> (version=TLS1.3, cipher=TLS_AES_128_GCM_SHA256); Fri, 23 Feb 2024 16:03:18 GMT\"],[\"Received\",\"by mail-yb1-f170.google.com with SMTP id 3f1490d57ef6-dc6dbac5fd1so352413276.0 for <updates@app.realpeoplecrm.com>; Fri, 23 Feb 2024 08:03:18 -0800 (PST)\"],[\"Received\",\"from [10.103.230.43] ([50.168.171.166]) by smtp.gmail.com with ESMTPSA id v192-20020a252fc9000000b00dc74efa1bb4sm3413712ybv.13.2024.02.23.08.03.15 for <updates@app.realpeoplecrm.com> (version=TLS1_2 cipher=ECDHE-ECDSA-AES128-GCM-SHA256 bits=128/128); Fri, 23 Feb 2024 08:03:16 -0800 (PST)\"],[\"X-Envelope-From\",\"nicrosental@gmail.com\"],[\"X-Mailgun-Incoming\",\"Yes\"],[\"Dkim-Signature\",\"v=1; a=rsa-sha256; c=relaxed/relaxed; d=gmail.com; s=20230601; t=1708704197; x=1709308997; darn=app.realpeoplecrm.com; h=mime-version:subject:references:in-reply-to:message-id:to:from:date :from:to:cc:subject:date:message-id:reply-to; bh=fD6yOWzun+uWZRFdIhrRXuTEbgcUdjMb6quHm2zv0MI=; b=ElHI7lpgTdwRH4gCq6VYSDzycprdq+Gw6gZ4WY1FWeIrZsrJsWLQFY6gE/R9DtlMRe uv/LpWgZvVN+gFjSujX2S4OmtMY/7PTOcCNW6DWDyBiucsdt64yVPkmAkm3owdDAnEaU smOkcIiAUTqLLrawae7uNiZlFSXToO83NzVHAprUZO6+dQ4ocdZlNTz7cUoGX1PG4hQQ OQ8280MZeWfZrG9IqRSnc88IjAdYjiGxYEAlSvJce+XISWKA0u3g17Lomdn0IX4t8Fnj 9IPiw5o5ISHAtqPdYp3oLpz0JD6GUteNaQAFfpZK4magO0ny5XcCN4v2MjNzraWDvorf FTuQ==\"],[\"X-Google-Dkim-Signature\",\"v=1; a=rsa-sha256; c=relaxed/relaxed; d=1e100.net; s=20230601; t=1708704197; x=1709308997; h=mime-version:subject:references:in-reply-to:message-id:to:from:date :x-gm-message-state:from:to:cc:subject:date:message-id:reply-to; bh=fD6yOWzun+uWZRFdIhrRXuTEbgcUdjMb6quHm2zv0MI=; b=PnBqm1ztWEeQH3Uzoyx/MpYNQmwWJGy1/qv+BWXOQ+vNH/mkwBEjyq5TtU7hri6moF yz4DvMZsOeskkZYn2uMNsukb8yXB34d6byT+fsOJx1cmLrL17XDKlt9ujYLlyIJvt0H+ Iwp9Yzp06RRILh+HGyyzXa6FA10sR2OnwfuKIoZbhYIpQlp8/wOuzyPE1o27Grux3xfI aLKIeH1MRlleCMr780c6xz9lUzKJWshI4VvheiYRH8a+/NSm/jBZ0rVPsBdYqDmt54Jo WaDrRrj/LggXUzVke4FH6MtmnFKhHu51NQQsHakG8+tZ3jlPDIoWLoCN6DyQfBOtbliQ A5CQ==\"],[\"X-Gm-Message-State\",\"AOJu0YzT7mtI6FmmLY0xNFe+rTnS8d8lyPNXQL/uCZs+wNApYOec4c7o 7Xl/6uNlqi/5u3zwUr206oO67/cqAXD1YA4QGzccBNOimSZhsG5RTnJI1ciXiRs=\"],[\"X-Google-Smtp-Source\",\"AGHT+IEQ3nNrkv78lXj6sgdSd38cMkjjmVdsS8Cheze9fPUj6R6P34HtfqfgP+f1v+EY+Ri+Jbg0hw==\"],[\"X-Received\",\"by 2002:a25:ce02:0:b0:dc7:491a:18c2 with SMTP id x2-20020a25ce02000000b00dc7491a18c2mr154322ybe.6.1708704196379; Fri, 23 Feb 2024 08:03:16 -0800 (PST)\"],[\"Return-Path\",\"<nicrosental@gmail.com>\"],[\"Date\",\"Fri, 23 Feb 2024 11:03:09 -0500\"],[\"From\",\"Nic Rosental <nicrosental@gmail.com>\"],[\"To\",\"updates@app.realpeoplecrm.com\"],[\"Message-Id\",\"<00a67994-93d4-4952-b544-62f5e189c6d7@Spark>\"],[\"In-Reply-To\",\"<CAD+BDRHcJgES3WiXCo5-7d48HFObFTquaWKcJH9hHZ28wYCrmg@mail.gmail.com>\"],[\"References\",\"<c7b274b3-44aa-4601-9d47-1946e4a3744c@Spark> <CAD+BDRHcJgES3WiXCo5-7d48HFObFTquaWKcJH9hHZ28wYCrmg@mail.gmail.com>\"],[\"Subject\",\"Fwd: Re: Follow up\"],[\"X-Readdle-Message-Id\",\"00a67994-93d4-4952-b544-62f5e189c6d7@Spark\"],[\"Mime-Version\",\"1.0\"],[\"Content-Type\",\"multipart/alternative; boundary=\\\"65d8c1c2_9fe2bec_15532\\\"\"]]',
    'recipient' => 'updates@app.realpeoplecrm.com',
    'sender' => 'nicrosental@gmail.com',
    'signature' => 'ad9ceb97c3a70509657fc0d7e389ba47fd885fb4e0aa12cabaaec2233e23e95d',
    'stripped-html' => '<html xmlns=\"http://www.w3.org/1999/xhtml\"><head>
<title></title>
</head>
<body>
<div name=\"messageSignatureSection\"><br>
<div dir=\"auto\"><span style=\"color:#000000;background-color:#ffffff;font-family:sans-serif;font-size: 14px\">Nic&#160;Rosental</span><span style=\"font-size: 14px\"><br></span><a style=\"background-color:#ffffff;font-family:sans-serif;font-size: 14px\" href=\"https://nicrosental.com/\" target=\"_blank\">nicrosental.com</a><span style=\"font-size: 14px\"><br></span><a style=\"background-color:#ffffff;font-family:sans-serif;font-size: 14px\" href=\"https://linkedin.com/in/rosental\" target=\"_blank\">LinkedIn</a><span style=\"font-size: 14px\"><br></span></div>
</div>
<div name=\"messageReplySection\">---------- Forwarded message ----------<br>
<b>From:</b> Kristin Slink &lt;kristin@iamtechaf.com&gt;<br>
<b>Date:</b> Feb 23, 2024 at 10:54&#8239;AM -0500<br>
<b>To:</b> Nic Rosental &lt;nicrosental@gmail.com&gt;<br>
<b>Subject:</b> Re: Follow up<br>
<br>
<blockquote type=\"cite\">
<div dir=\"ltr\">Thank you for your time today Nic! I\'m looking forward&#160;to the Fractionals United group and will pass along your information&#160;to any founders I run into looking for some technical expertise and support.
<div><br></div>
<div>Kristin</div>
</div>
<br>
<br clear=\"all\">
<div><br></div>
<span class=\"gmail_signature_prefix\">--</span><br>
<div dir=\"ltr\" class=\"gmail_signature\">
<div dir=\"ltr\"><img src=\"https://ci3.googleusercontent.com/mail-sig/AIorK4yfCn72_s8gapa6o-cg33uPSfrxPDL1JSlWFnk-m5VWltO60mnm9VgUFBhxJ2MKdrFkIpKm07M\"><br>
<div><a href=\"https://www.iamtechaf.com/your-startup-tech-advisor\" target=\"_blank\">Tech Advisory Packages</a><br></div>
<div><a href=\"https://www.iamtechaf.com/supporterscontributetoequity\" target=\"_blank\">Sponsor Women Founders</a><br></div>
<div><br></div>
<div><br></div>
</div>
</div>
</blockquote>
</div>


</body></html>',
    'stripped-signature' => '> Tech Advisory Packages
> Sponsor Women Founders
>
>',
    'stripped-text' => 'Nic Rosental
nicrosental.com
LinkedIn
---------- Forwarded message ----------
From: Kristin Slink <kristin@iamtechaf.com>
Date: Feb 23, 2024 at 10:54 AM -0500
To: Nic Rosental <nicrosental@gmail.com>
Subject: Re: Follow up

> Thank you for your time today Nic! I\'m looking forward to the Fractionals United group and will pass along your information to any founders I run into looking for some technical expertise and support.
>
> Kristin
>
>
> On Fri, Feb 23, 2024 at 10:28 AM Nic Rosental <nicrosental@gmail.com> wrote:
> > > Hi Kristin,
> > >
> > > It was great chatting with you. I already put in the request for you to get an invite to Fractionals United, please let me know if you don\'t get one in the next few days. My services can be found on my website and I will send the one-pager as soon as I have it ready.
> > >
> > > I\'m looking forward to meeting you in person soon.
> > >
> > > Best,
> > >
> > > Nic Rosental
> > > nicrosental.com
> > > LinkedIn
>
>
> --
>',
    'subject' => 'Fwd: Re: Follow up',
    'timestamp' => '1708704198',
    'token' => 'e047e56bfab2e5a5188917027f7a0a9fee8be6e3466065a252',
]
*/
