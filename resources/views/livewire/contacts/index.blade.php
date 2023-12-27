<div>
    @session('message')
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endsession

    <button wire:click="$dispatch('openModal', {component: 'contacts.modal' })">New</button>

    @foreach($contacts as $c) 
        <div wire:key="{{ $c->id }}">
            <div>
                <div>
                    <h1>{{ $c->first_name }} {{ $c->middle_name ? substr($c->middle_name, 0, 1) . '.' : '' }} {{ $c->last_name }}</h1>
                    <phone>{{ $c->phone }}</phone>
                    <p class="card-text">{{ $c->email }}</p>
                    <p class="card-text">{{ $c->linkedin }}</p>
                    <p class="card-text">{{ $c->twitter }}</p>
                    <p class="card-text">{{ $c->youtube }}</p>
                    <p class="card-text">{{ $c->website }}</p>
                    <p class="card-text">{{ $c->preferred_contact_method }}</p>
                    <a  class="card-link">Edit</a>
                    <livewire:contacts.delete :contact="$c" />
                    <button wire:click="$dispatch('openModal', {component: 'contacts.modal', arguments: {{ json_encode(['contact' => $c->id]) }} })">Edit</button>

                </div>
            </div>
        </div>
    @endforeach
</div>