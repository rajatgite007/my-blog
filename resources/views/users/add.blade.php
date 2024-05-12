@extends('layouts.master')
@section('title') @lang('translation.user_card') @endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1') @lang('translation.users') @endslot
        @slot('title') @lang('translation.new') @endslot
    @endcomponent

    <form action="{{ route('users.submit') }}" method="post" class="row" enctype="multipart/form-data">
        @csrf
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex flex-wrap align-items-center justify-content-between">
                    <h4 class="card-title mb-0">@lang('translation.user_card')</h4>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('users') }}" class="btn btn-outline-warning"><i class="ri-delete-back-2-line"></i> @lang('translation.cancel')</a>
                        <button type="submit" class="btn btn-outline-success"><i class="ri-save-line"></i> @lang('translation.save')</button>
                    </div>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-2 col-sm-4">
                            <label class="form-label">@lang('translation.id')</label>
                        </div>
                        <div class="col-md-4 col-sm-8">{{ $nextId }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-2 col-sm-12">
                            <label class="form-label">@lang('translation.dni')</label>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <input type="text" name="dni" value="{{ old('dni') }}" placeholder="@lang('translation.dni')" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-2 col-sm-12">
                            <label class="form-label">@lang('translation.name') *</label>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="@lang('translation.name')" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-2 col-sm-12">
                            <label class="form-label">@lang('translation.last_name_1') *</label>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <input type="text" name="last_name_1" value="{{ old('last_name_1') }}" placeholder="@lang('translation.last_name_1')" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-2 col-sm-12">
                            <label class="form-label">@lang('translation.last_name_2')</label>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <input type="text" name="last_name_2" value="{{ old('last_name_2') }}" placeholder="@lang('translation.last_name_2')" class="form-control">
                        </div>
                    </div>

                    <div class="border row mb-3 py-3">
                        <div class="row mb-3">
                            <div class="col-md-2 col-sm-12">
                                <label class="form-label">@lang('translation.company') *</label>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <select class="form-control select2" name="company_id" onchange="get_locations(this.value)" required>
                                    <option value="">@lang('translation.choose_company')</option>
                                    @foreach ($activeCompany as $r)
                                        <option value="{{ $r->company_id }}" {{ old('company_id') == $r->company_id ? 'selected' : '' }}>{{ $r->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-2 col-sm-12">
                                <label class="form-label">@lang('translation.main_role') *</label>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <select class="form-control select2" name="role_id" required>
                                    <option value="">@lang('translation.choose_role')</option>
                                    @foreach ($activeRoles as $r)
                                        @if(isSuperAdmin() || $r->name != 'Superadmin')
                                        <option value="{{ $r->role_id }}" {{ old('role_id') == $r->role_id ? 'selected' : '' }}>{{ $r->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-check form-check-outline form-check-success mb-3">
                                    <input class="form-check-input" name="have_same_role" value="1" {{ old('have_same_role') == '0' ? '' :'checked' }} onchange="toggleStoreRoles()" type="checkbox" id="formCheck15">
                                    <label class="form-check-label" for="formCheck15">@lang('translation.same_role_in_all_stores')</label>
                                </div>
                            </div>
                        </div>
                        <div class="store-roles-container">
                            <div class="row mb-3">
                                <div class="col-lg-2 col-md-6 fw-light">@lang('translation.stores')</div>
                                <div class="col-lg-4 col-md-6 fw-light">@lang('translation.roles')</div>
                            </div>


                            @foreach ($activeLocations as $l)
                            <div class="row mb-3">
                                <div class="col-lg-2 col-md-6">{{ $l->name }}</div>
                                <div class="col-lg-4 col-md-6">
                                    <select class="form-control select2 store-roles" name="roles[{{ $l->location_id }}]" required>
                                        <option value="">@lang('translation.choose_role')</option>
                                        @foreach ($activeRoles as $r)
                                            <option value="{{ $r->role_id }}" {{ @old('roles')[$l->location_id] == $r->role_id ? 'selected' : '' }}>{{ $r->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-2 col-md-2">
                                    <div class="form-check form-check-outline form-check-success mb-3">
                                        <input class="form-check-input" name="default_store" value="1" type="radio" id="formCheck{{ $r->role_id }}">
                                        <label class="form-check-label" for="formCheck{{ $r->role_id }}">@lang('translation.store_by_default')</label>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-2 col-sm-12">
                            <label class="form-label">@lang('translation.phone')</label>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <input type="text" name="phone" value="{{ old('phone') }}" placeholder="@lang('translation.phone')" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-2 col-sm-12">
                            <label class="form-label">@lang('translation.email') *</label>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="@lang('translation.email')" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-2 col-sm-12">
                            <label class="form-label">@lang('translation.password') *</label>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <input type="password" name="password" value="{{ old('password') }}" placeholder="@lang('translation.password')" class="form-control mb-1" required>
                            <span class="fw-light">@lang('translation.minimum_8_characters_with_a_symbol_a_cap_and_a_number')</span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-2 col-sm-12">
                            <label class="form-label">@lang('translation.key') *</label>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <input type="password" name="key" value="{{ old('key') }}" maxlength="4" pattern="[0-9]{4}" title="@lang('translation.please_enter_4_digit_pin')" placeholder="@lang('translation.key')" class="form-control mb-1" required>
                            <span class="fw-light">4 @lang('translation.numbers')</span>
                        </div>
                    </div>

                    <hr />
                    <div class="form-check form-switch form-switch-right form-switch-md">
                        <label for="statusSwitch" class="form-label text-muted">@lang('translation.status')</label>
                        <input name="status" value="1" {{ old('status')=='0' ? '' :'checked' }} class="form-check-input code-switcher" type="checkbox" id="statusSwitch">
                    </div>
                    
                </div><!-- end card-body -->

                <div class="card-footer">
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('users') }}" class="btn btn-outline-warning"><i class="ri-delete-back-2-line"></i> @lang('translation.cancel')</a>
                        <button type="submit" class="btn btn-outline-success"><i class="ri-save-line"></i> @lang('translation.save')</button>
                    </div>
                </div>
                <!-- end card-footer -->

            </div><!-- end card -->
        </div>
        <!-- end col -->
    </form>
    <!-- end row -->
@endsection

@section('script')
<script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>

<script>
$(document).ready(function(){
    toggleStoreRoles();

    $("select[name='role_id']").select2({
        placeholder: "@lang('translation.choose_role')"
    });
    $("select[name='company_id']").select2({
        placeholder: "@lang('translation.choose_company')"
    });
    $(".store-roles").select2({
        placeholder: "@lang('translation.choose_role')"
    });
})
function toggleStoreRoles(){
    if(!$("input[name=have_same_role]").prop("checked")){
        $(".store-roles-container").show().find("select").prop({disabled: false, required: true});
        $(".store-roles").select2({
            placeholder: "@lang('translation.choose_role')"
        });
        return;
    }

    $(".store-roles-container").hide().find("select").val('').prop({disabled: true, required: false});
    $(".store-roles").select2({
        placeholder: "@lang('translation.choose_role')"
    });
}
function get_locations(company_id){
    $.ajax({
        type:'get',
        url: "{{ url('/location/active') }}/" + company_id,
        dataType: 'JSON',
        success: function (res){
            let html = `<div class="row mb-3">
                            <div class="col-lg-2 col-md-6 fw-light">@lang('translation.stores')</div>
                            <div class="col-lg-4 col-md-6 fw-light">@lang('translation.roles')</div>
                        </div>`;

            for (let i in res){
                html += `<div class="row mb-3">
                            <div class="col-lg-2 col-md-6">${res[i].name}</div>
                            <div class="col-lg-4 col-md-6">
                                <select class="form-control select2 store-roles" name="roles[${res[i].location_id}]" required>
                                    <option value="">@lang('translation.choose_role')</option>
                                    @foreach ($activeRoles as $r)
                                        <option value="{{ $r->role_id }}">{{ $r->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-2 col-md-2">
                                <div class="form-check form-check-outline form-check-success mb-3">
                                    <input class="form-check-input" name="default_store" value="${res[i].location_id}" type="radio" id="formCheck${res[i].location_id}">
                                    <label class="form-check-label" for="formCheck${res[i].location_id}">@lang('translation.store_by_default')</label>
                                </div>
                            </div>
                        </div>`;
            }

            $(".store-roles-container").html(html);
            toggleStoreRoles();
        },
        error: function(){
        }
    })
}
</script>
@endsection
