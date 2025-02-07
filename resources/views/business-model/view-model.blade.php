@extends('layouts.primary')
@section('content')
    <div class=" row mt-1 d-print-none">
        <div class="col">
            <h5 class="text-secondary fw-bolder">
                {{__('Business Model Canvas of')}} {{$model->company_name}}
            </h5>
        </div>
        <div class="col text-end">
            
            <a href="#" onclick="window.print()"
               class="btn bg-gradient-dark btn-sm add_event waves-effect waves-light">{{__('Print')}}</a>
            <a href="#" onclick="generatePDF()"
               class="btn bg-gradient-info btn-sm add_event waves-effect waves-light">{{__('PDF')}}</a>
            <a href="/design-business-model?id={{$model->id}}"
               class="btn btn-sm btn-warning add_event waves-effect waves-light">{{__('Edit')}}</a>
            <a href="/delete/business-model/{{$model->id}}"
               class="btn btn-sm btn-danger add_event waves-effect waves-light">{{__('Delete')}}</a>
        </div>
    </div>
    <div class="" id="businessModelPDF">
        <div class="">

            <div class="table-responsive bg-purple-light">
                <table class="table align-items-center mb-0 table-bordered">
                    <thead>
                    <tr>
                        <th class=""><label>{{__('Key partners')}}</label>
                        </th>
                        <th class=""><label>{{__('Key activities')}}</label>

                        </th>
                        <th class=""><label>{{__('Value Propositions')}}</label>

                        </th>
                        <th class=""><label>{{__('Customer Relationships')}}</label>

                        </th>

                        <th scope="col"><label>{{__('Customer Segments')}}</label>

                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="">
                            {!!clean($model->partners)!!}
                        </td>
                        <td>
                            {!!clean($model->activities)!!}</td>
                        <td>
                            {!!clean($model->value_propositions)!!}
                        </td>
                        <td>
                            {!!clean($model->customer_relationships)!!}
                        </td>
                        <td>{!!clean($model->customer_segments)!!}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <label>{{__('Key Resources')}}</label>

                            <p>{!!clean($model->resources)!!}</p>
                        </td>
                        <td></td>

                        <td>
                            <label>{{__('Channels')}}</label>
                            <p>{!!clean($model->channels)!!}</p>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <label>{{__('Cost Structure')}}</label>
                            {!!clean($model->cost_structure)!!}

                        </td>
                        <td colspan="3"><label>{{__('Revenue Stream')}}</label>
                            {!!clean($model->revenue_stream)!!}

                        </td>
                    </tr>
                    <tr></tr>
                    <tr></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script>
    function generatePDF() {
        const { jsPDF } = window.jspdf;
        
        // Create a new jsPDF instance with custom size
        const doc = new jsPDF();

        // Get the HTML content
        const element = document.getElementById('businessModelPDF'); // Replace 'content' with the ID of your HTML element
      
        // Convert HTML to PDF using html2pdf
        html2pdf(element, {
            margin: 10,
            filename: 'Business Model Canvas of {{$model->company_name}}.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' },

        });
    }
</script>
@endsection