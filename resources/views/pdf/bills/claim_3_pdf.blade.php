<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Claim 3 Bill Trainee List</title>
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
      max-width: fit-content;
      max-height: fit-content;
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
      font-size: 5.2pt;
    }
    .summary-table th,
    .summary-table td {
      font-size: 4.8pt;
    }
    .header-table th,
    .header-table td {
      font-size: 6.5pt;
    }

    table th {
      padding: 3.75pt 3.75pt;
      color: #5D6975;
      border-bottom: .75pt solid #C1CED9;
      white-space: nowrap;
      font-weight: normal;
    }

    table td {
      padding: 3.75pt 2pt;
      text-align: right;
      word-wrap: break-word;
    }

    table td.service,
    table td.desc {
      vertical-align: top;
    }

    table td.unit,
    table td.qty,
    table td.total {
      font-size: 5pt;
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
      margin: 20px 30px 30px 30px;
    }
  </style>
</head>

<body>
  <header class="clearfix">
    @php $bill_info = $pdfInfo['bill_info']; $trainee_info = $pdfInfo['trainee_info']; @endphp
    <h1 align="right" style="padding-top: -14.5pt;">INVOICE</h1>
    <div class="head" style="font-size: 15px;"><img src="https://seip-bee.tappware.com{{$bill_info['entity_info']['attach_file_info']['file_path']}}" width="30pt" style="vertical-align: middle;"> <b>[{{$bill_info['entity_info']['entity_short_name']}}]-{{$bill_info['entity_info']['entity_name']}}</b></div>

    <div class="company clearfix" style="padding: 0px; margin: 0px;float: left; font-size: 8pt;">
      <div><span>INVOICE SUBMITTED TO:</span></div>
      <div>Skills for Employment Investment Program</div>
      <div>Probashi Kalyan Bhaban (Level-16),<br /> 71-72 Old Elephant Road,<br /> Eskaton Road, Dhaka-1000.</div>
    </div>
    <div class="project clearfix" style=" padding: 0px; margin: 0px; float: right; font-size: 8pt;">
      <div><span>BILL NO</span> : {{$bill_info['bill_no']}}</div>
      <div><span>CERTIFICATE BILL NO</span> : Bill-{{$bill_info['certification_bill_no']}}:Claim-2</div>
      <div><span>CONTRACT</span> : {{$bill_info['contract']}}</div>
      <div><span>SUBMITTED DATE</span> : {{date('d-m-Y', strtotime($bill_info['bill_date']))}}</div>
      <div><span>SUBMITTED BY</span> : {{$bill_info['submitted_by']}}</div>
      <div><span>SYSTEM REF</span> : {{$bill_info['entity_id']}}-{{$bill_info['bill_sequence_no']}}-{{$bill_info['claim_no']}}-{{date("Ymd")}}</div>
    </div>
  </header>
  <main>
    <table class="header-table" style="margin-bottom: 7.5pt; margin-top: 2.5pt">
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
          <td style="text-align:center">{{$bill_info['total_batch']}}</td>
          <td style="text-align:center">{{$bill_info['total_trainee']}}</td>
          <td style="text-align:center">{{number_format($bill_info['gross_amount'], 2)}}</td>
          <td style="text-align:center">{{number_format($bill_info['contribution_amount'], 2)}}</td>
          <td style="text-align:center">{{number_format($bill_info['net_amount'], 2)}}</td>
        </tr>
      </tbody>
    </table>
    <table class="summary-table" style="table-layout: fixed;">
      <thead >
        <tr>
          <th style="width: 3%">Sl</th>
          <th >TI</th>
          <th >Course</th>
          <th style="width: 3%">BN</th>
          <th style="text-align:center; width: 5%">Claim-1 <br># (A)</th>
          <th style="text-align:center; width: 5%">Claim-1 <br>Fee %</th>
          <th style="text-align:center">Course <br> Fee (B)</th>
          <th >Total Bill <br>(C=A*B)</th>
          <th style="text-align:center">Claim-1 <br>Bill(D)</th>
          <th style="text-align:center; width: 5%">Claim-2 <br># (E)</th>
          <th style="text-align:center">Net Bill <br>(F=B*E)</th>
          <th style="text-align:center">Claim-2 <br>Fee % (CF)</th>
          <th style="text-align:center">Claim-2 Bill <br>(G=F%(CF))</th>
          <th style="text-align:center; width: 5%">Claim-3 <br># (H)</th>
          <th style="text-align:center">Claim-3 Bill <br>(I=F-(D+G))</th>
          <th >Dif</th>
          <th >Bill Date</th>
          <th >Start Date</th>
          <th >End Date</th>
        </tr>
      </thead>
      <tbody>
        @php $sl = 1; @endphp
        @foreach($bill_info['bill_list'] as $key=>$value)
        <tr>
          <td class="left">{{$sl++}}</td>
          <td style="text-align:left">{{$value['institute_info']['institute_name']}}</td>
          <td style="text-align:left">
            {{$value['course_info']['code']}} | {{$value['course_info']['course_name']}} |{{$value['course_info']['month']}} |{{$value['course_info']['hour']}} | {{$value['course_info']['unit_cost_total']}}
          </td>
          <td style="text-align:center">{{$value['batch_info']['batch_sequence_number']}}</td>
          <td style="text-align:center">{{$value['enroll_count']}}</td>
          <td style="text-align:center">
            {{$value['e_pay_percentage']}}
          </td>
          <td style="text-align:left">{{number_format($value['unit_cost'], 2)}}</td>
          <td style="text-align:left">{{number_format($value['total_bill_amount'], 2)}}</td>
          <td style="text-align:left">{{number_format($value['e_bill_amount'], 2)}}</td>
          <td style="text-align:center">{{$value['certification_count']}}</td>
          <td style="text-align:left">{{number_format($value['net_bill'], 2)}}</td>
          <td style="text-align:center">{{$value['c_pay_percentage']}}</td>
          <td style="text-align:left">{{number_format($value['cer_bill_amount'], 2)}}</td>
          <td style="text-align:center">{{$value['placement_count']}}</td>
          <td style="text-align:left">{{number_format($value['bill_amount'], 2)}}</td>
          <td style="text-align:left">{{number_format($value['adjustment_amount'], 2)}}</td>
          <td style="text-align:left"> {{$value['bill_date']}}</td>
          <td style="text-align:left"> {{$value['batch_info']['start_date']}}</td>
          <td style="text-align:left"> {{$value['batch_info']['end_date']}}</td>
        </tr>
        @endforeach
        <tr>
          <td colspan="3" align="left"> <b> Total</b></td>
          <td>{{$bill_info['total_batch']}}</td>
          <td style="text-align:center">{{$bill_info['total_enroll']}}</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td style="text-align:center" >{{$bill_info['total_certified']}}</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td style="text-align:left">{{$bill_info['total_trainee']}}/{{number_format(($bill_info['total_trainee']/$bill_info['total_certified'])*100)}}%</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="17" align="right"><b>A) Gross Amount</b></td>
          <td colspan="2">{{number_format($bill_info['gross_amount'], 2)}}</td>
        </tr>
        <tr>
          <td colspan="17" align="right"><b>B) IA\'S Contribution</b></td>
          <td colspan="2">{{$bill_info['contribution_percentage']}} % </td>
        </tr>
        <tr>
          <td colspan="17" align="right"><b>C) Contribution Amount (A*B)</b></td>
          <td colspan="2"> {{number_format($bill_info['contribution_amount'], 2)}}</td>
        </tr>
        <tr>
            <td colspan="17" align="right"><b>D) Bill Amount (A - C)</b></td>
            <td colspan="2">{{number_format($bill_info['bill_after_contribution'], 2)}}</td>
        </tr>
        <tr>
            <td colspan="17" align="right"><b>E) Manual Adjustment by FM</b></td>
            <td colspan="2">{{number_format($bill_info['manual_adjustment_amount'], 2)}}</td>
        </tr>
        <tr>
            <td colspan="17" align="right"><b>F) Payable Amount (D - E)</b></td>
            <td colspan="2">@if($bill_info['bill_amount_after_manual_adjustment'] == 0 ){{number_format($bill_info['bill_after_contribution'], 2)}} @else {{number_format($bill_info['bill_amount_after_manual_adjustment'], 2)}} @endif</td>
        </tr>
        <tr>
          <td colspan="17" align="right"><b>G) Adjustment of Mobilization Advance (F * 40%)</b></td>
          <td colspan="2"> {{number_format($bill_info['adjusted_amt'], 2)}}</td>
        </tr>
        <tr>
            <td colspan="17" align="right"><b>H) Net Payable (F - G)</b></td>
            <td colspan="2">@if($bill_info['bill_amount_after_manual_adjustment'] == 0 ){{number_format(($bill_info['bill_after_contribution']-$bill_info['adjusted_amt']), 2)}} @else {{number_format(($bill_info['bill_amount_after_manual_adjustment']-$bill_info['adjusted_amt']), 2)}} @endif</td>
        </tr>
        <tr>
            <td colspan="17" align="right"><b>I) Percentage(%) of Job Placement (Till Previous Bill)</b></td>
            <td colspan="2">{{number_format($bill_info['previous_job_per'], 2)}}</td>
        </tr>
        <tr>
            <td colspan="17" align="right"><b>J) Cumulative (%) of Job Placement (Till Current Bill)</b></td>
            <td colspan="2">{{number_format($bill_info['current_job_per'], 2)}}</td>
        </tr>
      </tbody>
    </table>

    <div class="page-break"></div>
    @php $isl = 1; @endphp
    @foreach($trainee_info as $tkey=>$tvalue)
    <div class="clearfix">
      <h2 align="right" style="padding-top: -15pt;">TRAINEE LIST OF {{$bill_info['bill_no']}}</h2>
      <div class="head">
        <span style="font-size: 15px;"><img src="https://seip-bee.tappware.com{{$bill_info['entity_info']['attach_file_info']['file_path']}}" width="30pt" style="vertical-align: middle;"> <b>[{{$bill_info['entity_info']['entity_short_name']}}]-{{$bill_info['entity_info']['entity_name']}}</b></span>
        <span style="float: right;"">{{$isl++}}</span>
          </div>
          <div class=" company clearfix" style="width: 75%; padding: 0px; margin: 0px;float: left; font-size: 8.25pt;">
          <div><strong>Institute : </strong>{{$tvalue['bill_info']['institute_info']['institute_name']}}</div>
          <div><strong>Course : </strong>{{$tvalue['bill_info']['course_info']['course_name']}}</div>
          <div><strong>Batch : </strong>{{$tvalue['bill_info']['batch_info']['batch_sequence_number']}}</div>
      </div>
      <div class="project clearfix" style=" padding: 0px; margin: 0px; float: right; font-size: 8.25pt;">
        <div><span>SUBMITTED DATE</span> {{date('d-m-Y', strtotime($bill_info['bill_date']))}}</div>
        <div><span>SUBMITTED BY</span> {{$bill_info['submitted_by']}}</div>
        <div><span>SYSTEM REF</span> {{$bill_info['entity_id']}}-{{$bill_info['bill_sequence_no']}}-{{$bill_info['claim_no']}}-{{date("Ymd")}}</div>
      </div>
    </div>
    <table style="margin-bottom: 7.5pt">
      <thead>
        <tr>
          <th>Total Student</th>
          <th>Female</th>
          <th>Male</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td style="text-align:center">{{$tvalue['total_trainee']}}</td>
          <td style="text-align:center">{{$tvalue['female_trainee']}}</td>
          <td style="text-align:center">{{$tvalue['male_trainee']}}</td>
        </tr>
      </tbody>
    </table>

    <table align='center' style="table-layout: fixed;">
      <thead style="table-layout: fixed;">
        <tr style="table-layout: fixed;">
          <th style="width: 3%">Sl</th>
          <th style="text-align:center; ">Photo</th>
          <th style="text-align:center; ">Reference <br>Number</th>
          <th style="text-align:center; ">Registration <br>Number</th>
          <th style="text-align:left; ">Trainee Name</th>
          <th style="text-align:left; ">Org Name</th>
          <th style="text-align:left; ">Org Address</th>
          <th style="text-align:center; ">Emp <br>Duration From</th>
          <th style="text-align:center; ">Emp <br>Duration To</th>
          <th >Mobile</th>
          <th style="text-align:center; ">Assessment <br>Date</th>
          <th style="text-align:center; ">Job <br>Months</th>
          <th style="text-align:center; ">Monthly <br>Income (BDT)</th>
        </tr>
      </thead>
      <tbody>
        @php $tsl = 1; @endphp
        @foreach($tvalue['trainee_list'] as $tekey=>$trainee)
        <tr>
          <td style="text-align:left">{{$tsl++}}</td>
          <td style="text-align:center">@if(isset($trainee['attach_file_info']))<img src="https://seip-bee.tappware.com{{$trainee['attach_file_info']['file_path']}}" height="17pt" width="17pt" style="vertical-align: middle;"> @else <img src="" height="17pt" width="17pt" style="vertical-align: middle;"> @endif</td>
          <td style="text-align:left">{{$trainee['reference_number']}}</td>
          <td style="text-align:left">{{$trainee['registration_number']}}</td>
          <td style="text-align:left">{{$trainee['trainee_name']}}</td>
          <td style="text-align:left">{{$trainee['current_trainee_employment']['organization_name']}}</td>
          <td style="text-align:left">{{$trainee['current_trainee_employment']['organization_address']}}</td>
          <td style="text-align:left">{{$trainee['current_trainee_employment']['joining_date']}}</td>
          <td style="text-align:left">Till Date</td>
          <td style="text-align:center">{{$trainee['mobile']}}</td>
          <td style="text-align:center">{{date('d-m-Y', strtotime($trainee['training_assessment']['assessment_date']))}}</td>
          <td style="text-align:center">
            @php
                $today = date("Y-m-d");
                $date1 = date_create($today);
                $ass_date = date_create($trainee['current_trainee_employment']['joining_date']);
                $diff = date_diff($date1, $ass_date);
                $day_diff = $diff->format("%a");
            @endphp
             {{(int)($day_diff/30)}}
            </td>
          <td style="text-align:center">{{$trainee['current_trainee_employment']['salary']}}</td>
        </tr>
        @endforeach

        <tr>
          <td colspan='7' style="text-align:left"><b>Total Student: {{$tvalue['total_trainee']}}</b></td>
          <td colspan='3' style="text-align:left">Female: {{$tvalue['female_trainee']}}</td>
          <td colspan='3' style="text-align:left">Male: {{$tvalue['male_trainee']}}</td>
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
