<x-layouts.app>
    <x-slot name="title">{{ __('Clients') }}</x-slot>
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('Clients') }}</li>
            </ol>
        </nav>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <a href="{{ route('clients.create') }}" class="btn btn-primary float-lg-right">
                                    {{ __('New') }} {{ __('Client') }}
                                </a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-stripped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">{{ __('Name') }}</th>
                                        <th scope="col">{{ __('E-mail') }}</th>
                                        <th scope="col">{{ __('CPF') }}</th>
                                        <th scope="col">{{ __('Phone') }}</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php /** @var $model \App\Models\Client */@endphp
                                    @foreach($data as $model)
                                        <tr>
                                            <th scope="row">{{ \Str::limit($model->id, 8, '') }}</th>
                                            <td>{{ $model->name }}</td>
                                            <td>{{ $model->email }}</td>
                                            <td>{{ $model->cpf }}</td>
                                            <td>{{ $model->phone }}</td>
                                            <td style="width: 100px">
                                                <a href="{{ route('clients.edit', $model) }}"
                                                   data-toggle="tooltip" data-placement="top" title="{{ __('Edit') }}"
                                                   class="btn btn-sm btn-primary">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                         fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                        <path
                                                            d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                                    </svg>
                                                </a>
                                                <a
                                                    href="javascript:void(0)"
                                                    data-toggle="tooltip" data-placement="top"
                                                    title="{{ __('Delete') }}"
                                                    class="btn btn-sm btn-danger"
                                                    onclick="confirmDelete('Tem certeza que deseja remover {{ $model->name }}?', 'client-delete-{{$model->id}}')"
                                                >
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                         fill="currentColor" class="bi bi-trash-fill"
                                                         viewBox="0 0 16 16">
                                                        <path
                                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                                    </svg>
                                                </a>
                                                <form id="client-delete-{{$model->id}}" method="post"
                                                      action="{{ route('clients.destroy', $model) }}">
                                                    @csrf @method('delete')
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script type="text/javascript">
            function confirmDelete(message, id) {
                if (window.confirm(message)) {
                    const form = document.getElementById(id);
                    form.submit();
                }
            }
        </script>
    @endpush
</x-layouts.app>
