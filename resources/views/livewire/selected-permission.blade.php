<div class="row">

    @forelse($permissions as $permission)

        <div class="col-12 col-lg-2">

            <div class="toast fade show" role="alert" aria-live="assertive" data-bs-autohide="false" aria-atomic="true">

                <div class="toast-header">
                    <button wire:click="removePermissionFromRole('{{ $permission->id }}', '{{ $role_id }}')" type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button> 
                    &nbsp;&nbsp;<small style="padding-left: 20px; color: #000;" class="p-1">{{ ucwords( str_replace("-", " ", $permission->name))}}</small>
                    
                </div>

            </div><br/>
        </div>

    @empty

        <div class="alert alert-info" style="padding:20px; font-size:1.5em; font-style:bold;">No Permissions selected.</div>

    @endforelse


</div>