<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="js/app.js"></script>
</head>
<body>
<div>
    <a href="{{ route('contacts.import.google') }}">Import Contacts from Google</a>

    @if($contacts && count($contacts) > 0)
        @foreach ($contacts as $contact)
            <div id="contact-{{ $contact['id'] }}">
                <p>
                    {{ $contact['first_name'] }} 
                    {{ $contact['last_name'] }} | 
                    ({{ $contact['display_name'] }}) | 
                    {{ $contact['email'] }} <button onClick="discardImportedContact({{ $contact['id'] }})">Discard</button>
                </p>
            </div>
        @endforeach
    @endif
</div>
</body>
