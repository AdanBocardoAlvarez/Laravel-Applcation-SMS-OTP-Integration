@extends('layouts.primary')
@section('content')
    <div class=" row">
        <div class="col">
            <h5 class="mb-2 text-secondary fw-bolder">
                {{__('SWOT Analysis')}}
            </h5>
        </div>
        <div class="col text-end">
            <a href="/write-swot" type="button" class="btn btn-info " data-bs-toggle="modal" data-bs-target="#exampleModal">  {{__('New SWOT Analysis')}}</a>

        </div>
    </div>




    <div>
        <div class="row">
            @foreach($models as $model)
                <div class="col-lg-4 col-md-6 col-12 mt-lg-0 mb-3">
                    <div class="card mb-3 mt-lg-0 mt-4">
                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="col-md-11">
                                    <div class="d-flex">

                                        @php
                                            $initial = $model->company_name['0'];
                                            $bgColors = ['primary', 'secondary', 'success', 'warning', 'info', 'dark'];
                                            $bgIndex = array_search($initial, range('A', 'Z')) % count($bgColors);
                                            $bgColor = $bgColors[$bgIndex]
                                        @endphp

                                        <div class="avatar rounded-circle avatar-sm me-2 bg-{{$bgColor}} border-radius-md p-2">
                                            <h5 class="mt-2 text-white text-uppercase">{{$initial}}</h5>
                                        </div>
                                        <h5 class=" fw-bolder text-dark text-primary">
                                            <a href="/view-swot?id={{$model->id}}">{{$model->company_name}}</a>

                                        </h5>
                                    </div>

                                    <p class="text-sm mt-2">{{__('Related Product')}}:<span class="text-dark fw-bolder"> @if(!empty($products[$model->product_id]))
                                                @if(isset($products[$model->product_id]))
                                                    {{$products[$model->product_id]->title}}
                                                @endif
                                            @endif</span></p>
                                    <p class="text-sm">{{__('Designed By')}}:<span class="text-purple fw-bolder"> @if(isset($users[$model->admin_id]))
                                                {{$users[$model->admin_id]->first_name}} {{$users[$model->admin_id]->last_name}}
                                            @endif</span></p>
                                    <p class="text-sm">{{__('Created At')}}:
                                        <span class="badge bg-info"> {{(\App\Supports\DateSupport::parse($model->updated_at))->format(config('app.date_format'))}}</span></p>



                                </div>
                                <div class="col-1 text-end">
                                    <div class="dropstart">
                                        <a href="javascript:" class="text-secondary" id="dropdownMarketingCard"
                                           data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-lg-start px-2 py-3"
                                            aria-labelledby="dropdownMarketingCard">
                                            <li><a class="dropdown-item border-radius-md"
                                                   href="/write-swot?id={{$model->id}}">{{__('Edit')}}</a></li>

                                            <li><a class="dropdown-item border-radius-md"
                                                   href="/view-swot?id={{$model->id}}">{{__('See Details')}}</a></li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li><a class="dropdown-item border-radius-md text-danger"
                                                   href="/delete/swot/{{$model->id}}">{{__('Delete')}}</a></li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{__('Business Model Canvas')}}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="/save-swot">
                        @if ($errors->any())
                            <div class="alert bg-pink-light text-danger">
                                <ul class="list-unstyled">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="row">
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">
                                    {{__('Business/Company Name')}}
                                </label><label class="text-danger">*</label>
                                <input class="form-control" name="company_name" id="company_name">
                            </div>

                        </div>
                        <div class="">

                            <label for="exampleFormControlInput1" class="form-label">{{__('Select Product')}}</label>
                            <select class="form-select form-select-solid fw-bolder" id="contact"
                                    aria-label="Floating label select example" name="product_id">
                                <option value="0">{{__('None')}}</option>
                                @foreach ($products as $product)
                                    <option value="{{$product->id}}"
                                            @if (!empty($model))
                                            @if ($model->product_id === $product->id)
                                            selected
                                        @endif
                                        @endif
                                    >{{$product->title}}</option>
                                @endforeach
                            </select>
                        </div>



                        @csrf
                        <button class="btn btn-info mt-4" type="submit">{{__('Save')}}</button>
                        <button type="button" class="btn btn-secondary mt-4" data-bs-dismiss="modal">{{__('Close')}}</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
