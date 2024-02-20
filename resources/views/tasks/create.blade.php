<x-app-layout>
    <x-slot name="headeassets">
        <script type="text/javascript" src='//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
        <!--<![endif]-->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create A New Task') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-black p-5">
                    <h3 class="text-2xl text-white">Create new Task</h3>
                </div>
                <div class="p-6 text-gray-900">
                    {!! Form::open(['route' => 'tasks.store', 'method' => 'POST', 'class' => 'max-w-sm mx-auto']) !!}
                    <div class="mb-5">
                        {!! Form::label('admin', __('Admin Name'), [
                            'class' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
                        ]) !!}

                        {!! Form::select('assigned_by_id', [], null, [
                            'id' => 'admin',
                            'class' => 'form-input admins_selectbox',
                            'placeholder' => 'Task admin ...',
                            'required' => false,
                        ]) !!}
                        @error('assigned_by_id')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">Admin is required</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        {!! Form::label('title', __('Title'), [
                            'class' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
                        ]) !!}

                        {!! Form::text('title', null, [
                            'id' => 'title',
                            'class' => $errors->has('title') ? 'form-error' : 'form-input',
                            'placeholder' => 'Task title ...',
                            'required' => false,
                        ]) !!}

                        @error('title')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">Title is required</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        {!! Form::label('description', __('Description'), [
                            'class' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
                        ]) !!}

                        {!! Form::textarea('description', null, [
                            'id' => 'description',
                            'class' => $errors->has('description') ? 'form-error' : 'form-input',
                            'placeholder' => 'Task description ...',
                            'required' => false,
                            'rows' => 2,
                        ]) !!}
                        @error('description')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">Description is required</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        {!! Form::label('user', __('Assigned User'), [
                            'class' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
                        ]) !!}

                        {!! Form::select('assigned_to_id', [], null, [
                            'id' => 'user',
                            'class' => 'form-input users_selectbox',
                            'placeholder' => 'Task user ...',
                            'required' => false,
                        ]) !!}

                        @error('assigned_to_id')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">User is required</p>
                        @enderror
                    </div>

                    {!! Form::submit('Create New Task', [
                        'class' =>
                            'md:block p-3 px-6 pt-2 text-white bg-black rounded-full baseline hover:bg-brightRedLight cursor-pointer',
                    ]) !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <x-slot name="footerassets">

        <script>
            var oldValue = 1;

            function useSelect2(userType) {
                return {
                    ajax: {
                        url: "{{ url()->current() }}",
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            return {
                                term: params.term,
                                userType: userType,
                                page: params.page
                            };
                        },
                        processResults: function(data, params) {
                            params.page = params.page || 1;

                            return {
                                results: data.data,
                                pagination: {
                                    more: data.last_page != params.page
                                }
                            };
                        },
                        cache: true
                    },
                    placeholder: `Search in ${userType}`,
                    minimumInputLength: 1,
                    templateResult: formatRepo,
                    templateSelection: formatRepoSelection
                }
            }

            $(".admins_selectbox").select2(useSelect2('admin'));
            $(".users_selectbox").select2(useSelect2('user'));

            $('.admins_selectbox').val(2).change();

            function formatRepo(repo) {
                if (repo.loading) {
                    return repo.text;
                }

                var $container = $(
                    "<div class='select2-result-repository__meta'>" +
                    "<div class='select2-result-repository__name'></div>" +
                    "</div>"
                );

                $container.find(".select2-result-repository__name").text(repo.name);

                return $container;
            }

            function formatRepoSelection(repo) {
                return repo.name;
            }
        </script>
    </x-slot>
</x-app-layout>
