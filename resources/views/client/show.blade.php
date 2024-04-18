@extends('layouts.master')
@section('title')
    Dashboard
@endsection
@section('css')
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            HIM
        @endslot
        @slot('li_2')
            Client
        @endslot
        @slot('li_3')
            Show
        @endslot
        @slot('title')
            Client
        @endslot
    @endcomponent

    <form id="myForm">


        <div class="row p-3">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Client Information</h4>
                        <p class="text-muted mb-0">
                        </p>
                    </div><!--end card-header-->
                    <div class="card-body bootstrap-select-1">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-label">First Name</label>

                                            <input type="text" name="first_name" class="form-control" parsley-type="text"
                                                placeholder="Enter First Name" value="{{ $user->first_name }}" disabled>


                                            <span class="text-danger">
                                                @error('first_name')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-label">Last Name</label>

                                            <input type="text" name="last_name" class="form-control" parsley-type="text"
                                                placeholder="Enter Last Name" value="{{ $user->last_name }}" disabled>



                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-label">Height</label>

                                            <input type="text" name="first_name" class="form-control" parsley-type="text"
                                                value="{{ $user->height ?? 'N/A' }}" disabled>



                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-label">Weight</label>

                                            <input type="text" name="last_name" class="form-control" parsley-type="text"
                                                value="{{ $user->weight ?? 'N/A ' }}" disabled>



                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-label">Email Address</label>

                                            <input type="email" name="email" class="form-control" parsley-type="text"
                                                value="{{ $user->email }}" disabled>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-label">Contact</label>

                                            <input type="text" name="phone" class="form-control" parsley-type="text"
                                                value="{{ $user->phone ?? 'N/A' }}" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-label">Date Of Birth</label>

                                            <input type="email" name="email" class="form-control" parsley-type="text"
                                                 value="{{ $user->date_of_birth??'N/A' }}" disabled>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-label">Goal</label>

                                            <input type="text" name="phone" class="form-control" parsley-type="text"
                                                value="{{ $user->goal ?? 'N/A' }}" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-label">Medical History</label>
                                            <textarea class="form-control"  disabled>
                                                {!!$user->medical_history ?? 'N/A' !!}
                                            </textarea>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-label">Allergens</label>
                                            <textarea class="form-control"  disabled>
                                                {!! $user->allergens ?? 'N/A' !!}
                                            </textarea>

                                            {{-- <input type="text" name="phone" class="form-control" parsley-type="text"
                                                value="" disabled> --}}
                                        </div>
                                    </div>
                                </div>

                                @if ($user->is_dietician)
                                    <div class="form-group">
                                        <label class="form-label">qualification</label>

                                        <textarea name="qualification" id="" class="form-control" rows="5">{{ $user->qualification }}</textarea>


                                        <span class="text-danger">
                                            @error('qualification')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">experience</label>

                                        <textarea name="experience" id="" class="form-control" rows="5">{{ $user->experience }}</textarea>


                                        <span class="text-danger">
                                            @error('experience')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                @endif


                            </div><!-- end col -->

                            <span class="text-danger">
                                @error('password')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div><!-- end row -->
                        @if (Auth::user()->is_dietician)
                        <a href="{{route('generate-user',$user->id)}}"><button class="btn btn-primary text-white" type="button">Generate Diet Plan</button></a>
                        @endif
                    </div><!-- end card-body -->

                </div> <!-- end card -->
            </div> <!-- end col -->

        </div>

    </form>
@endsection
@section('script')
    <script>
        $('#myForm').on('submit', function(event) {
            event.preventDefault(); // Prevent the form from submitting normally



            let isValid = true;
            var toastContainer = $('#warning-toast').find('.toast-container');
            toastContainer.empty();
            var isFirstIteration = true;
            $(this).find('[required]').each(function() {
                $(this).siblings('.error-message').remove();

                if ($(this).val() === '') {
                    isValid = false; // If a required field is empty, set isValid to false
                    $(this).addClass('error'); // Optionally, add a CSS class for styling
                    // $(this).siblings('label').addClass('error'); // Optionally, add a CSS class for styling
                    $(this).siblings('.error-message').remove();
                    var name = $(this).siblings('label').text().trim(); // Get label text
                    if (!name) {
                        name = $(this).attr(
                            'name'); // If label text is empty, get the name attribute
                        var parts = name.split('[question]').filter(Boolean);

                        // Join the parts with spaces
                        var convertedName = parts.join('Question ');
                        convertedName = convertedName.replace(
                            /\[|\]|\_/g, ' ').trim();
                        name = convertedName;
                    }


                    $(this).before(' <span class="error-message error">*' + name +
                        ' is required</span>');
                    if (isFirstIteration) {

                        isFirstIteration = false;
                        var errorPosition = $(this).siblings('.error-message').offset().top;
                        $('html, body').animate({
                            scrollTop: (errorPosition - 50)
                        }, 500);

                        $(this).css('border', '1px solid red');
                        $(this).focus();
                    }
                    var toast = $('#toast-content').first().clone();
                    toast.find('h5').text(
                        `${name} is required`, );
                    toast.removeClass('d-none');
                    toast.toast({
                        autohide: true
                    });
                    var toastContainer = $('#warning-toast').find('.toast-container');
                    toastContainer.children('.toast').hide();
                    toastContainer.append(toast);
                    toastContainer.children('.toast').removeClass('d-none');
                    toastContainer.children('.toast').show({
                        autohide: true
                    });
                    // $(this).css('border', '1px solid yellow');

                } else {
                    $(this).removeClass('error'); // Optionally, add a CSS class for styling
                    $(this).siblings('label').removeClass('error');
                    $(this).siblings('.error-message').remove();
                    $(this).css('border', '').focus();
                    if ($(this).attr('type') === 'email' && !isValidEmail($(this).val())) {
                        var name = $(this).siblings('label').text().trim(); // Get label text
                        if (!name) {
                            name = $(this).attr(
                                'name'); // If label text is empty, get the name attribute
                            var parts = name.split('[question]').filter(Boolean);

                            // Join the parts with spaces
                            var convertedName = parts.join('Question ');
                            convertedName = convertedName.replace(
                                /\[|\]|\_/g, ' ').trim();
                            name = convertedName;
                        }

                        name += ' Invalid email';
                        isValid = false;
                        $(this).before(' <span class="error-message error">*' + name +
                            '</span>');
                        if (isFirstIteration) {

                            isFirstIteration = false;
                            var errorPosition = $(this).siblings('.error-message').offset().top;
                            $('html, body').animate({
                                scrollTop: (errorPosition - 50)
                            }, 500);

                            $(this).css('border', '1px solid red');
                            $(this).focus();
                        }

                    }

                }


            });

            // Call the validation function when the form is submitted
            if (isValid) {

                $('#myForm').unbind('submit').submit();
            } else {
                return false
            }
        });

        function isValidEmail(email) {
            // Use a regular expression to check for a valid email format
            var emailRegex = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i;
            return emailRegex.test(email);
        }
    </script>
    <script>
        window.onload = function() {
            setTimeout(function() {
                document.getElementById('password').value = '';
            }, 100);
        }
    </script>
@endsection
