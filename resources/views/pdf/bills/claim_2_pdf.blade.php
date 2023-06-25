<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Claim 2 Bill Trainee List</title>
  <style>
    .clearfix:after {
      content: "";
      display: table;
      clear: both;
    }

    a {
      color: #5D6975;
      text-decoration: underline;
    }

    body {
      position: relative;
      width: 18cm;
      height: 29.7cm;
      margin: 0 auto;
      color: #001028;
      background: #FFFFFF;
      font-family: Arial, sans-serif;
      font-size: 7.5pt;
    }

    header {
      padding: 0px 0;
      margin-bottom: 3.75pt;
    }

    .headerClass {
      padding: 0px 0;
      margin-bottom: 3.75pt;
    }

    .head {
      border-top: 1px solid #5D6975;
      border-bottom: 1px solid #5D6975;
      color: #5D6975;
      font-size: 13.5pt;
      line-height: 1.4em;
      font-weight: normal;
      margin: 0 0 7.5pt 0;
    }

    .project span {
      color: #5D6975;
      text-align: right;
      width: 39pt;
      margin-right: 7.5pt;
      display: inline-block;
      font-size: 0.8em;
    }

    .company span {
      color: #5D6975;
      text-align: right;
      margin-right: 7.5pt;
      display: inline-block;
      font-size: 9pt;
    }


    .project div,
    .company div {
      white-space: nowrap;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      border-spacing: 0;
      margin-bottom: 14.5pt;
    }

    table tr:nth-child(2n-1) td {
      background: #F5F5F5;
    }

    table th,
    table td {
      text-align: center;
      font-size: 7.5pt;
    }

    table th {
      padding: 3.75pt 3.75pt;
      color: #5D6975;
      border-bottom: .75pt solid #C1CED9;
      white-space: nowrap;
      font-weight: normal;
    }

    table td {
      padding: 3.75pt;
      text-align: right;
    }

    table td.service,
    table td.desc {
      vertical-align: top;
    }

    table td.unit,
    table td.qty,
    table td.total {
      font-size: 7.5pt;
    }

    table td.grand {
      border-top: 1px solid #5D6975;
      ;
    }

    .page-break {
      page-break-after: always;
    }

    footer {
      color: #5D6975;
      width: 100%;
      height: 22.5pt;
      position: absolute;
      bottom: 0;
      border-top: 1px solid #C1CED9;
      padding: 6pt 0;
      text-align: center;
    }

    #footer {
      position: fixed;
      right: 0px;
      bottom: -10px;
      text-align: center;
    }

    #footer .page:after {
      content: counter(page, decimal);
    }

    @page {
      margin: 20px 30px 40px 30px;
    }
  </style>
</head>

<body>
  <header class="clearfix">
    @php $bill_info = $pdfInfo['bill_info']; $trainee_info = $pdfInfo['trainee_info']; $is_edc = $pdfInfo['is_edc']; @endphp
    <h1 align="right" style="padding-top: -14.5pt;">INVOICE</h1>
    <div class="head" style="font-size: 15px;"><img src="https://seip-bee.tappware.com{{$bill_info['entity_info']['attach_file_info']['file_path'] ?? ''}}" width="30pt" style="vertical-align: middle;"> <b>[{{$bill_info['entity_info']['entity_short_name'] ?? ''}}]-{{$bill_info['entity_info']['entity_name'] ?? ''}}</b></div>

    <div class="company clearfix" style="padding: 0px; margin: 0px;float: left; font-size: 8pt;">
      <div><span>INVOICE SUBMITTED TO:</span></div>
      <div>Skills for Employment Investment Program</div>
      <div>Probashi Kalyan Bhaban (Level-16),<br /> 71-72 Old Elephant Road,<br /> Eskaton Road, Dhaka-1000.</div>
    </div>
    <div class="project clearfix" style=" padding: 0px; margin: 0px; float: right; font-size: 8pt;">
      <div><span>BILL NO</span> : {{$bill_info['bill_no'] ?? ''}}</div>
      <div><span>CONTRACT</span> : {{$bill_info['contract']?? ''}}</div>
      <div><span>SUBMITTED DATE</span> : {{date('d-m-Y', strtotime($bill_info['bill_date']))}}</div>
      <div><span>SUBMITTED BY</span> : {{$bill_info['submitted_by'] ?? ''}}</div>
      <div><span>SYSTEM REF</span> : {{$bill_info['entity_id'] ?? ''}}-{{$bill_info['bill_sequence_no'] ?? ''}}-{{$bill_info['claim_no'] ?? ''}}-{{date("Ymd")}}</div>
    </div>
  </header>
  <main>
    <table style="margin-bottom: 7.5pt">
      <thead>
        <tr>
          <th>Total Batch</th>
          <th>Total Student</th>
          <th>Gross Amount</th>
          <th>Contribution Amount</th>
          <th>Net Payable</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td style="text-align:center">{{$bill_info['total_batch'] ?? ''}}</td>
          <td style="text-align:center">{{$bill_info['total_assessed'] ?? ''}}</td>
          <td style="text-align:center">{{number_format($bill_info['gross_amount'] ?? 0, 2)}}</td>
          <td style="text-align:center">{{number_format($bill_info['contribution_amount'] ?? 0, 2)}}</td>
          <td style="text-align:center">{{number_format($bill_info['net_amount'] ?? 0, 2)}}</td>
        </tr>
      </tbody>
    </table>
    <table>
      <thead>
        <tr>
          <th>Sl</th>
          <th>TI</th>
          <th>Course</th>
          <th>BN</th>
          <th>Enrolled</th>
          @if($is_edc)
          <th>Net Count</th>
          @else
          <th>Assessed</th>
          <th>Certified</th>
          @endif
          <th>Unit Cost</th>
          <th>Pay %</th>
          <th>Payment Amount</th>
          <th>Bill Amount</th>
        </tr>
      </thead>
      <tbody>
        @php $sl = 1; @endphp
        @foreach($bill_info['bill_list'] as $key=>$value)
        <tr>
          <td class="center">{{$sl++}}</td>
          <td style="text-align:left">{{$value['institute_info']['institute_name'] ?? ''}}</td>
          <td style="text-align:left">
            {{$value['course_info']['code'] ?? ''}} | {{$value['course_info']['course_name'] ?? ''}} |{{$value['course_info']['month'] ?? ''}} |{{$value['course_info']['hour'] ?? ''}} | {{$value['course_info']['unit_cost_total'] ?? ''}}
          </td>
          <td style="text-align:center">{{$value['batch_info']['batch_sequence_number'] ?? ''}}</td>
          <td style="text-align:center"> {{$value['enroll_count'] ?? ''}}</td>
          @if($is_edc)
          <td style="text-align:center">
            {{$value['trainee_count'] ?? ''}}
          </td>
          @else
          <td style="text-align:center">
            {{$value['trainee_count'] ?? ''}}
          </td>
          <td style="text-align:center">
            {{$value['certified_count'] ?? ''}}
          </td>
          @endif
          <td style="text-align:left">@if(isset($value['updated_unit_cost']) && !empty($value['updated_unit_cost'])){{number_format($value['updated_unit_cost'], 2)}} @else {{number_format($value['unit_cost'], 2)}} @endif</td>
          <td style="text-align:left">{{$value['pay_percentage'] ?? ''}}</td>
          <td style="text-align:left">@if(isset($value['updated_fee_per_trainee']) && !empty($value['updated_fee_per_trainee'])){{number_format($value['updated_fee_per_trainee'], 2)}} @else {{number_format($value['fee_per_trainee'], 2)}} @endif</td>
          <td style="text-align:left">@if(isset($value['updated_bill_amt']) && !empty($value['updated_bill_amt'])){{number_format($value['updated_bill_amt'], 2)}} @else {{number_format($value['bill_amount'], 2)}} @endif</td>
        </tr>
        @endforeach
        <tr>
          <td colspan="3" align="left"> <b> Total</b></td>
          <td style="text-align:center">{{$bill_info['total_batch'] ?? ''}}</td>
          <td style="text-align:center">{{$bill_info['total_enroll'] ?? ''}}</td>
          @if($is_edc)
          <td style="text-align:center">{{$bill_info['total_assessed'] ?? ''}}</td>
          @else
          <td style="text-align:center">{{$bill_info['total_assessed'] ?? ''}}</td>
          <td style="text-align:center">{{$bill_info['total_certified'] ?? ''}}</td>
          @endif
          <td style="text-align:center"></td>
          <td style="text-align:center"></td>
          <td style="text-align:center"></td>
          <td style="text-align:center"></td>
        </tr>
        @php if($is_edc) $colspan = 9; else $colspan = 10; @endphp
        <tr>
          <td colspan="{{$colspan}}" align="right"><b>A) Gross Amount</b></td>
          <td>{{number_format($bill_info['gross_amount'] ?? 0, 2)}}</td>
        </tr>
        <tr>
          <td colspan="{{$colspan}}" align="right"><b>B) IA\'S Contribution</b></td>
          <td>{{$bill_info['contribution_percentage'] ?? ''}} % </td>
        </tr>
        <tr>
          <td colspan="{{$colspan}}" align="right"><b>C) Contribution Amount (A*B)</b></td>
          <td>{{number_format($bill_info['contribution_amount'] ?? 0, 2)}}</td>
        </tr>
        <tr>
          <td colspan="{{$colspan}}" align="right"><b>D) Net Payable (A - C)</b></td>
          <td>{{number_format($bill_info['net_amount'] ?? 0, 2)}}</td>
        </tr>
      </tbody>
    </table>

    <div class="page-break"></div>
    @php $isl = 1; @endphp
    @foreach($trainee_info as $tkey=>$tvalue)
    <div class="clearfix">
      <h2 align="right" style="padding-top: -15pt;">TRAINEE LIST OF {{$bill_info['bill_no']}}</h2>
      <div class="head">
        <span style="font-size: 15px;"><img src="https://seip-bee.tappware.com{{$bill_info['entity_info']['attach_file_info']['file_path'] ?? ''}}" width="30pt" style="vertical-align: middle;"> <b>[{{$bill_info['entity_info']['entity_short_name'] ?? ''}}]-{{$bill_info['entity_info']['entity_name'] ?? ''}}</b></span>
        <span style="float: right;"">{{$isl++}}</span>
          </div>
          <div class=" company clearfix" style="width: 75%; padding: 0px; margin: 0px;float: left; font-size: 8.25pt;">
          <div><strong>Institute : </strong>{{$tvalue['bill_info']['institute_info']['institute_name'] ?? ''}}</div>
          <div><strong>Course : </strong>{{$tvalue['bill_info']['course_info']['course_name'] ?? ''}}</div>
          <div><strong>Batch : </strong>{{$tvalue['bill_info']['batch_info']['batch_sequence_number'] ?? ''}}</div>
      </div>
      <div class="project clearfix" style=" padding: 0px; margin: 0px; float: right; font-size: 8.25pt;">
        <div><span>SUBMITTED DATE</span> {{date('d-m-Y', strtotime($bill_info['bill_date']))}}</div>
        <div><span>SUBMITTED BY</span> {{$bill_info['submitted_by'] ?? ''}}</div>
        <div><span>SYSTEM REF</span> {{$bill_info['entity_id'] ?? ''}}-{{$bill_info['bill_sequence_no'] ?? ''}}-{{$bill_info['claim_no'] ?? ''}}-{{date("Ymd")}}</div>
      </div>
    </div>
    <table style="margin-bottom: 7.5pt">
      <thead>
        <tr>
          <th>Total Student</th>
          <th>Female</th>
          <th>Male</th>
          @if($is_edc)

          @else
            <th>Dropout</th>
            <th>Absent</th>
          @endif
        </tr>
      </thead>
      <tbody>
        <tr>
          <td style="text-align:center">{{$tvalue['total_trainee'] ?? ''}}</td>
          <td style="text-align:center">{{$tvalue['female_trainee'] ?? ''}}</td>
          <td style="text-align:center">{{$tvalue['male_trainee'] ?? ''}}</td>
          @if($is_edc)

          @else
            <td style="text-align:center">{{$tvalue['t_dropout'] ?? ''}}</td>
            <td style="text-align:center">{{$tvalue['t_absent'] ?? ''}}</td>
          @endif

        </tr>
      </tbody>
    </table>

    <table align='center'>
      <thead>
        <tr>
          <th>Sl</th>
          <th>Photo</th>
          <th style="text-align:left">Reference Number</th>
          <th style="text-align:left">Registration Number</th>
          <th style="text-align:left">Trainee Name</th>
          @if($is_edc)
            <th style="text-align:left">Attendance %</th>
            <th>Mobile</th>
            <th>DoB</th>
            <th>Gender</th>
          @else
            <th style="text-align:left">Assessor Name</th>
            <th>Assessment Date</th>
            <th>Assessment Score</th>
          @endif

        </tr>
      </thead>
      <tbody>
        @php $tsl = 1; @endphp
        @foreach($tvalue['trainee_list'] as $tekey=>$trainee)
        <tr>
          <td style="text-align:center">{{$tsl++}}</td>
          <td style="text-align:center">@if(isset($trainee->file_path) && stripos($trainee->file_name_uploaded, "jpg") === false)<img src="https://seip-bee.tappware.com{{$trainee->file_path ?? ''}}" height="17pt" width="17pt" style="vertical-align: middle;"> @else <img src="https://seip-bee.tappware.com{{$trainee->thumb_dir ?? $trainee->file_path}}" height="17pt" width="17pt" style="vertical-align: middle;"> @endif</td>
          <td style="text-align:left">{{$trainee->reference_number ?? ''}}</td>
          <td style="text-align:left">{{$trainee->registration_number ?? ''}}</td>
          <td style="text-align:left">{{$trainee->trainee_name ?? ''}}</td>
        @if($is_edc)
            <td style="text-align:left">{{$trainee->attendance_percentage ?? ''}}</td>
            <td style="text-align:left">{{$trainee->mobile ?? ''}}</td>
            <td style="text-align:left">{{date('d-m-Y', strtotime($trainee->date_of_birth))}}</td>
            <td style="text-align:left">{{$trainee->gender ?? ''}}</td>
        @else
            <td style="text-align:left">{{$trainee->assessor ?? ''}}</td>
            <td style="text-align:center">@if($trainee->attendance_percentage < $trainee->dropout_below_perc)  {{date('d-m-Y', strtotime($tvalue['assessment_date']))}} @else {{date('d-m-Y', strtotime($trainee->assessment_date))}} @endif</td>
            <td style="text-align:center">@if($trainee->attendance_percentage < $trainee->dropout_below_perc) Dropout @else @if($trainee->assessment_score == 0) Absent @elseif($trainee->assessment_score == 100) Competent @else Not Competent @endif @endif</td> }}
        @endif

        </tr>
        @endforeach

        <tr>
          <td colspan='4' style="text-align:left"><b>Total Student: {{$tvalue['total_trainee'] ?? ''}}</b></td>
          <td colspan='2' style="text-align:left">Female: {{$tvalue['female_trainee'] ?? ''}}</td>
          <td colspan='2' style="text-align:left">Male: {{$tvalue['male_trainee'] ?? ''}}</td>
        </tr>
      </tbody>
    </table>
    <div class="page-break"></div>
    @endforeach

  </main>
  <div id="footer">
    <p class="page">Page </p>
  </div>
</body>

</html>
