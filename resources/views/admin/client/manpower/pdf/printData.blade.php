<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Sheet</title>
    <link href="{{ asset('public/admin/assets/css/pdf/dataprint.css') }}" rel="stylesheet">
    <link href="{{ asset('public/admin/assets/css/fonts.css') }}" rel="stylesheet">

</head>
<body>
    <div class="data_sheet clear">

        <div class="data_header clear">
            <div class="header_left">
                <img src="{{ asset('public/admin/assets/images/Bangladesh_gov.png') }}" width="60" alt="">
            </div>
            <div class="header_center">
                <div class="top_center">Government of the People's Republic of Bangladesh</div>
                <div class="bottom_center">Bureau of Manpower, Employment and Training (BMET)</div>
            </div>
            <div class="header_right">
                <img src="{{ asset('public/admin/assets/images/BMET.png') }}" width="60" alt="">
            </div>
        </div>

        <div class="content clear">
            <div class="content_headline clear">Individual Clearance Application Form</div>
            <div class="content_number clear">
                <div class="left_number">Serial Number:</div>
                <div class="center_number">
                    <table id="numberTable">
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
                </div>
                <div class="right_number">Date.....................................</div>
            </div>
            <div class="content_visa clear">
                <div class="visa_headline clear">A. Visa Information</div>
                <div class="visa_body clear">
                    <div class="visa_top clear">
                        <div class="block_visa">
                            <div class="data_name">1. Block Visa No.:</div> 
                            <div class="data_info">{{ $customer_data[0]->visano_en }}</div>
                        </div>
                        <div class="visa_issue">
                            <div class="data_name">2. Visa Issue Date:</div> 
                            <div class="data_info">{{ $customer_data[0]->visa_date }}</div>
                        </div>
                    </div>
                    <div class="visa_middle clear">
                        <div class="issue_country">
                            <div class="data_name">3. Visa Issuing Country:</div> 
                            <div class="data_info">{{ $customer_stamping[0]->foreign_country }}</div>
                        </div>
                        <div class="delegation_visa">
                            <div class="data_name">4.Total Visa Count:</div> 
                            <div class="data_info">{{ $customer_data[0]->delegated_visa }}</div>
                        </div>
                    </div>
                    <div class="visa_bottom clear">
                        <div class="rl_number">
                            <div class="data_name">5. RL No.:</div> 
                            <div class="data_info">{{ $customer_data[0]->license }}</div>
                        </div>
                        <div class="ra_name">
                            <div class="data_name">6.RA Name:</div> 
                            <div class="data_info">{{ $customer_data[0]->title }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content_foreign clear">
                <div class="foreign_headline clear">B. Employer/Company/Foreign Recruiting Agent Information</div>
                <div class="foreign_body clear">
                    <div class="foreign_top clear">
                        <div class="confirmation">
                            <div class="data_name">7. Employer is a company or recruiting agent (foreign):</div> 
                            <div class="data_info">Yes/NO</div>
                        </div>
                    </div>
                    <div class="foreign_middle clear">
                        <div class="employer_name">
                            <div class="data_name">8. Employer/Company/Recruiting Agent (foreign) Name:</div> 
                            <div class="data_info">-</div>
                        </div>
                    </div>
                    <div class="foreign_middle_name clear">
                        <div class="employer_name">
                            <div class="data_info">-</div>
                        </div>
                    </div>
                    <div class="foreign_bottom clear">
                        <div class="street_address clear">
                            <div class="data_name">9. a) Street Address:</div> 
                            <div class="data_info">-</div>
                        </div>
                        <div class="address_info clear">
                            <div class="info_top clear">
                                <div class="left_info">
                                    <div class="data_name">b) City/Town:</div> 
                                    <div class="data_info">-</div>
                                </div>
                                <div class="right_info">
                                    <div class="data_name">c) Phone:</div> 
                                    <div class="data_info">-</div>
                                </div>
                            </div>
                            <div class="info_middle clear">
                                <div class="left_info">
                                    <div class="data_name">d) Zip Code:</div> 
                                    <div class="data_info">-</div>
                                </div>
                                <div class="right_info">
                                    <div class="data_name">e) Fax Number:</div> 
                                    <div class="data_info">-</div>
                                </div>
                            </div>
                            <div class="info_bottom clear">
                                <div class="left_info">
                                    <div class="data_name">f) E-Mail:</div> 
                                    <div class="data_info">-</div>
                                </div>
                                <div class="right_info">
                                    <div class="data_name">g) Website:</div> 
                                    <div class="data_info">-</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content_employee clear">
                <div class="employee_headline clear">C. Employee Information</div>
                <div class="employee_body clear">
                    <table id="employeeData">
                        <thead>
                            <tr>
                                <th width="25%">Item</th>
                                <th width="35%">Employee # 1</th>
                                <th width="20%">Employee # 2</th>
                                <th width="20%">Employee # 3</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Registration ID</td>
                                <td>{{ $customer_data[0]->finger_regno }}</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Visa Number</td>
                                <td>{{ $customer_stamping[0]->stamped_visano }}</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Visa Issue Date</td>
                                <td>{{ date('d-M-Y', strtotime($customer_stamping[0]->visa_issue)) }}</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Visa Expiry Date</td>
                                <td>{{ date('d-M-Y', strtotime($customer_stamping[0]->visa_expiry)) }}</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Visa Issue Country</td>
                                <td>{{ $customer_stamping[0]->foreign_country }}</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Visa Issue Place</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Type Of Visa</td>
                                <td>Employment</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Passport Type</td>
                                <td>International</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Category Name</td>
                                <td>{{ $customer_data[0]->occupation_en }}</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Purpose Of Visit</td>
                                <td>{{ $customer_data[0]->visatype_name }}</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Passport Number</td>
                                <td>{{ $customer_data[0]->passportNo }}</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Passport Issue Date</td>
                                <td>{{ date('d-M-Y', strtotime($customer_passports[0]->passportIssue)) }}</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Passport Expiry Date</td>
                                <td>{{ date('d-M-Y', strtotime($customer_passports[0]->passportExpiry)) }}</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Passport Issue Place</td>
                                <td>{{ $customer_passports[0]->issuePlace }}</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Profession in Passport</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Birth Date in Passport</td>
                                <td>{{ date('d-M-Y', strtotime($customer_passports[0]->dateOfBirth)) }}</td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="content_job clear">
                <div class="job_headline clear">D. Job Information</div>
                <div class="job_body clear">
                    <table id="jobData">
                        <thead>
                            <tr>
                                <th width="20%">Item</th>
                                <th width="36%">Job/Post Category # 1</th>
                                <th width="22%">Job/Post Category # 2</th>
                                <th width="22%">Job/Post Category # 3</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Name of Job/Post</td>
                                <td><strong>{{ $customer_data[0]->occupation_en }}</strong></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Monthly Wages/Salary</td>
                                <td><strong>{{ $customer_data[0]->salary }}</strong></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Food (Put √)</td>
                                <td>YES/NO</td>
                                <td>YES/NO</td>
                                <td>YES/NO</td>
                            </tr>
                            <tr>
                                <td>Housing (Put √)</td>
                                <td>YES/NO</td>
                                <td>YES/NO</td>
                                <td>YES/NO</td>
                            </tr>
                            <tr>
                                <td>Medical (Put √)</td>
                                <td>YES/NO</td>
                                <td>YES/NO</td>
                                <td>YES/NO</td>
                            </tr>
                            <tr>
                                <td>Air Fare (Put √)</td>
                                <td>YES/NO</td>
                                <td>YES/NO</td>
                                <td>YES/NO</td>
                            </tr>
                            <tr>
                                <td>Over time (Put √)</td>
                                <td>YES/NO</td>
                                <td>YES/NO</td>
                                <td>YES/NO</td>
                            </tr>
                            <tr>
                                <td>Contract Duration (Yr)</td>
                                <td><strong>{{ $customer_data[0]->visa_duration }}</strong></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Others</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Remarks</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="job_footer">
                        <span class="job_left">&#x2022;</span>
                        <span class="job_right">If required add extra pages for employee and job information</span>
                    </div>
                </div>
            </div>
            <div class="content_footer clear">
                <div class="top_footer clear">
                    <div class="sign_officer">Signature of the recipient Officer</div>
                    <div class="sign_applicant">Applicant's Signature</div>
                </div>
                <div class="bottom_footer clear">
                    <div class="email">E-Mail:<span class="email_address">Infor@bmet.org.bd</span></div>
                    <div class="web">Website:www.bmet.org.bd</div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>