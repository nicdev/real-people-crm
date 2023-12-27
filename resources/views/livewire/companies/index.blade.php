<div>
<livewire:shared.nav>
<livewire:shared.actions model="company">
    @session('message')
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endsession
    
    @foreach($companies as $c) 
        <div wire:key="{{ $c->id }}">
            <div>
                <div>
                    <h1>{{ $c->name }}</h1>
                    <phone>{{ $c->phone }}</phone>
                    <p class="card-text">{{ $c->email }}</p>
                    <p class="card-text">{{ $c->linkedin }}</p>
                    <p class="card-text">{{ $c->twitter }}</p>
                    <p class="card-text">{{ $c->youtube }}</p>
                    <p class="card-text">{{ $c->website }}</p>
                    <a  class="card-link">Edit</a>
                    <livewire:companies.delete :company="$c" />
                    <button wire:click="$dispatch('openModal', {component: 'companies.modal', arguments: {{ json_encode(['company' => $c->id]) }} })">Edit</button>

                </div>
            </div>
        </div>
    @endforeach
</div>