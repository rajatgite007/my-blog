<?php
function isSuperAdmin()
{
    if (auth()->check()) {
        $currentRole = authUserRole();
        $allowedRoles = ['Super Administrador'];

        if (in_array($currentRole, $allowedRoles)) {
            return true;
        }
    }

    return false;
}

function isCompanyAdministrator()
{
    if (auth()->check()) {
        $currentRole = authUserRole();
        $allowedRoles = ['Administrador de la Empresa', 'Super Administrador'];

        if (in_array($currentRole, $allowedRoles)) {
            return true;
        }
    }

    return false;
}

function isStoreAdministrator()
{
    if (auth()->check()) {
        $currentRole = authUserRole();
        $allowedRoles = ['Jefe de Tienda', 'Administrador de la Empresa', 'Super Administrador'];

        if (in_array($currentRole, $allowedRoles)) {
            return true;
        }
    }

    return false;
}

function isSalesPerson()
{
    if (auth()->check()) {
        $currentRole = authUserRole();
        $allowedRoles = ['Vendedor', 'Jefe de Tienda', 'Administrador de la Empresa', 'Super Administrador'];

        if (in_array($currentRole, $allowedRoles)) {
            return true;
        }
    }

    return false;
}

function isStoreKeeper()
{
    if (auth()->check()) {
        $currentRole = authUserRole();
        $allowedRoles = ['Bodega/Logistica', 'Vendedor', 'Jefe de Tienda', 'Administrador de la Empresa', 'Super Administrador'];

        if (in_array($currentRole, $allowedRoles)) {
            return true;
        }
    }

    return false;
}


// function isStoreKeeperSessionActive() {
//     if ( isStoreKeeper() ) {
//         function getWorkerName( $worker_id ) {
//             return  App\Shift::where()->where()->first();
//         }
//     }
// }

?>