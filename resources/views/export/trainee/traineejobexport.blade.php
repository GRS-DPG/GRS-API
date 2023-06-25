 <table>
     <thead>
         <tr class="bg-light fw-bolder fs-7 text-uppercase align-middle text-primary">
             <th style="border: 1px solid #50cd89 !important;
                                    text-align: center;font-weight: bold;" colspan="11">
                 <p>Trainee Job Placement List Summary</p>
             </th>
         </tr>
         <tr class="bg-light fw-bolder fs-7 text-uppercase align-middle text-primary">
             <th style="border: 1px solid #50cd89 !important;
                                    text-align: center;" colspan="11">
                 <p style="font-size: 7pt;"> @if($exportInfo['filter_data']['tranche_info']) @php $tranche=$exportInfo['filter_data']['tranche_info'] @endphp Tranche: {{$tranche['label']}} @endif @if($exportInfo['filter_data']['entity_info']) @php $entity= $exportInfo['filter_data']['entity_info'];@endphp ,Training Partner:{{$entity['entity_name']}}({{$entity['entity_short_name']}})@endif @if($exportInfo['filter_data']['course_info']) @php $course= $exportInfo['filter_data']['course_info'];@endphp ,Course: {{$course['course_name']}} @endif @if($exportInfo['filter_data']['institute_info']) @php $institute= $exportInfo['filter_data']['institute_info'];@endphp ,Institute: {{$institute['institute_name']}} @endif @if (isset($exportInfo['filter_data']['batch_info']['batch_number'])) @php $batch= $exportInfo['filter_data']['batch_info'];@endphp ,Batch: {{$batch['batch_number']}} @endif @if (isset($exportInfo['bill_no'])) ,Bill No: Bill-{{$exportInfo['bill_no']}}:Claim-3 @endif</p>
             </th>
         </tr>
         @if (isset($exportInfo['bill_no']))
         <tr class="bg-light fw-bolder fs-7 text-uppercase align-middle text-primary">
            <th style="border: 1px solid #50cd89 !important;
                                   text-align: center;" colspan="11">
                <p style="font-size: 7pt;">Total Trainee: {{$exportInfo['total_trainee']}} | Total Record: {{$exportInfo['total_record']}}</p>
            </th>
        </tr>
        @endif
         <tr style="text-align: center">
             <th style="font-weight: bold;color:black;">Sl</th>
             <th style="font-weight: bold;color:black;">Entity</th>
             <th style="font-weight: bold;color:black;">Training Institute</th>
             <th style="font-weight: bold;color:black;">Course Info</th>
             <th style="font-weight: bold;color:black;">Tranche</th>
             <th style="font-weight: bold;color:black;">Batch Info</th>
             <th style="font-weight: bold;color:black;">Registration Number</th>
             <th style="font-weight: bold;color:black;">Trainee Name</th>
             <th style="font-weight: bold;color:black;">Gender</th>
             <th style="font-weight: bold;color:black;">Birth Date</th>
             <th style="font-weight: bold;color:black;">Mobile</th>
             <th style="font-weight: bold;color:black;"> Alt Mobile</th>
             <th style="font-weight: bold;color:black;"> Email</th>
             <th style="font-weight: bold;color:black;">Organization Name</th>
             <th style="font-weight: bold;color:black;">Organization Address</th>
             <th style="font-weight: bold;color:black;">Joining Date</th>
             <th style="font-weight: bold;color:black;">Designation</th>
             <th style="font-weight: bold;color:black;">Salary</th>
             @if($exportInfo['bill_no'])
             <th style="font-weight: bold;color:black;">Batch Strat Day</th>
             <th style="font-weight: bold;color:black;">Batch End Day</th>
             @endif
         </tr>
     </thead>
     <tbody>
         @foreach($exportInfo['reports'] as $report)
         <tr class="" >
             <td >
                 {{$loop->iteration}}
             </td>
             <td >
                 {{$report['entity_info']['entity_short_name']}}
             </td>
             <td >
                 {{$report['institute_info']['institute_name']}}
             </td>
             <td >
                 {{$report['course_info']['course_name']}}
             </td>
             <td >
                 {{$report['tranche_info']['label']}}
             </td>
             <td >
                 {{$report['batch_info']['batch_number']}}
             </td>
             <td >
                 {{$report['registration_number']}}
             </td>
             <td >
                 {{$report['trainee_name']}}
             </td>
             <td >
                 {{$report['gender']}}
             </td>
             <td >
                 @php
                 $original_date = $report['date_of_birth'];
                 $timestamp = strtotime($original_date);
                 $new_date = date("d-m-Y", $timestamp);
                 @endphp
                 {{$new_date}}
             </td>
             <td >
                 @if (isset($report['mobile'])) {{$report['mobile']}} @endif
             </td>
             <td >
                 @if (isset($report['alternative_mobile'])) {{$report['alternative_mobile']}} @endif
             </td>
             <td >
                {{$report['email'] ?? ''}}
             </td>
             <td >
                 @if (isset($report['current_trainee_employment']['organization_name'])) {{$report['current_trainee_employment']['organization_name']}} @endif
             </td>
             <td>
                 @if (isset($report['current_trainee_employment']['organization_address'])) {{$report['current_trainee_employment']['organization_address']}} @endif
             </td>
             <td >
                 @if (isset($report['current_trainee_employment']['joining_date'])) {{$report['current_trainee_employment']['joining_date']}} @endif
             </td>
             <td >
                 @if (isset($report['current_trainee_employment']['designation'])) {{$report['current_trainee_employment']['designation']}} @endif
             </td>
             <td >
                 @if (isset($report['current_trainee_employment']['salary'])) {{$report['current_trainee_employment']['salary']}} @endif
             </td>
             @if($exportInfo['bill_no'])
                <td>
                    @php
                    $original_date = $report['batch_info']['start_date'];
                    $timestamp = strtotime($original_date);
                    $new_date = date("d-m-Y", $timestamp);
                    @endphp
                    {{$new_date}}
                </td>
                <td>
                    @php
                    $original_date = $report['batch_info']['end_date'];
                    $timestamp = strtotime($original_date);
                    $new_date = date("d-m-Y", $timestamp);
                    @endphp
                    {{$new_date}}
                </td>
            @endif
         </tr>
         @endforeach
     </tbody>
 </table>
