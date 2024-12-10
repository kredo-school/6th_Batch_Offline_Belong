@extends('layouts.app')

@section('content')
<style>
    body {
        font-family: Arial, sans-serif;
        line-height: 1.6;
        margin: 20px;
    }
    h1 {
        text-align: center;
        white-space: nowrap; /* テキストを折り返さない */
        overflow: hidden;    /* はみ出し部分を非表示にしない */
        text-overflow: ellipsis; /* 必要に応じて省略記号を使用 */
        margin-bottom: 20px;
        font-size: 35px; /* フォントサイズを調整 */
    }
    h2 {
        margin-top: 30px;
        text-align: left; /* 見出しも左揃えに */
    }
    ol {
        margin: 0 0 20px 20px;
        padding: 0;
    }
    ol li {
        margin-bottom: 10px;
    }
    .sub-list {
        margin: 10px 0 10px 20px;
    }
    .text-section {
        text-align: left; /* 全体のテキストを左揃えに */
    }
    .overlay-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        font-weight: bold;
        font-size: 46px;
        text-align: center;
    }
    .btn-container {
        display: flex;
        justify-content: center; /* 中央揃え */
        margin-top: 20px; /* ボタン周囲の余白 */
    }
</style>

<div class="container-fluid p-0">
    <!-- ヘッダー画像セクション -->
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card" style="margin-top: -1px;">
                <div class="card-header p-0 position-relative">
                    <img src="{{ asset('images/rule.jpg') }}" alt="Rules Image" style="width:100%; height:500px; object-fit:cover;">
                    <div class="overlay-text">Please strictly follow the rules.</div>
                </div>
            </div>
        </div>
    </div>

    <!-- コンテンツセクション -->
    <div class="row justify-content-center mt-5">
        <div class="col-md-8 text-section">
            <h1 class="text-center">Terms of Service for Group Watch Party & Gathering Application</h1>
            <br>
            <p class="text-end"><strong>Effective Date:</strong> [2024/12/10]</p>

            <p>Welcome to <strong>[Belong]</strong>! These Terms of Service ("Terms") govern your access and use of our platform, which enables users to organize and participate in group watch parties and gathering events. By using our application, you agree to abide by these Terms. If you do not agree, please refrain from using the application.</p>

            <h2>1. Eligibility</h2>
            <ol>
                <li><strong>Minimum Age Requirement:</strong> You must be at least 18 years old or the age of majority in your jurisdiction to use the application.</li>
                <li><strong>Account Responsibility:</strong> You are responsible for all activities that occur under your account. Please ensure your login credentials are kept secure and confidential.</li>
            </ol>

            <h2>2. User Conduct</h2>
            <ol>
                <li><strong>Appropriate Use:</strong>
                    <ol class="sub-list">
                        <li>You agree to use the application for lawful purposes only.</li>
                        <li>You must not host or promote events that involve illegal activities, discrimination, harassment, or any content that violates applicable laws or community standards.</li>
                    </ol>
                </li>
                <li><strong>Respect for Others:</strong>
                    <ol class="sub-list">
                        <li>Treat all participants with respect.</li>
                        <li>Do not engage in any behavior that could be considered abusive, threatening, defamatory, or otherwise objectionable.</li>
                    </ol>
                </li>
                <li><strong>Content Sharing:</strong>
                    <ol class="sub-list">
                        <li>Do not share copyrighted or pirated materials without proper authorization.</li>
                        <li>Ensure that all content shared during events complies with intellectual property laws.</li>
                    </ol>
                </li>
            </ol>

            <h2>3. Event Hosting</h2>
            <ol>
                <li><strong>Accurate Information:</strong> Hosts must provide clear and accurate details about the event, including time, location, and content.</li>
                <li><strong>Liability for Events:</strong> Hosts are solely responsible for the organization and management of their events, including ensuring the safety and well-being of participants.</li>
                <li><strong>Prohibited Events:</strong> Events that promote violence, hatred, or illegal activities are strictly forbidden.</li>
            </ol>

            <h2>4. Privacy and Data Usage</h2>
            <ol>
                <li><strong>Data Collection:</strong> We collect and process personal information as outlined in our Privacy Policy.</li>
                <li><strong>User Responsibility:</strong> Do not share sensitive or private information during events unless necessary.</li>
            </ol>

            <h2>5. Intellectual Property</h2>
            <ol>
                <li><strong>Application Ownership:</strong> All rights, titles, and interests in the application and its content are owned by [Application Name] or its licensors.</li>
                <li><strong>User Contributions:</strong> By submitting content, you grant [Application Name] a non-exclusive, royalty-free license to use, modify, and distribute your content in connection with the application.</li>
            </ol>

            <h2>6. Disclaimers and Limitation of Liability</h2>
            <ol>
                <li><strong>No Warranty:</strong> The application is provided "as-is" without warranties of any kind.</li>
                <li><strong>Event Risks:</strong> [Application Name] is not responsible for any disputes, injuries, or damages arising from events organized through the platform. Participation in events is at your own risk.</li>
            </ol>

            <h2>7. Suspension and Termination</h2>
            <ol>
                <li><strong>Account Suspension:</strong> We reserve the right to suspend or terminate your account if you violate these Terms.</li>
                <li><strong>Event Cancellation:</strong> We may cancel events that violate our policies or pose risks to users.</li>
            </ol>

            <h2>8. Amendments to Terms</h2>
            <ol>
                <li><strong>Changes to Terms:</strong> We may update these Terms periodically. Continued use of the application constitutes your acceptance of the revised Terms.</li>
                <li><strong>Notification:</strong> Significant changes will be communicated via email or in-app notifications.</li>
            </ol>

            <h2>9. Governing Law</h2>
            <p>These Terms are governed by and construed in accordance with the laws of [Your Jurisdiction]. Any disputes will be subject to the exclusive jurisdiction of the courts in [Your Jurisdiction].</p>

            <h2>10. Contact Us</h2>
            <p>For questions or concerns regarding these Terms, please contact us at [Contact Information].</p>

            <p>By using [Belong], you acknowledge that you have read, understood, and agreed to these Terms of Service. Enjoy connecting and creating memorable experiences with our community!</p>

            <br>
            <div class="btn-container">
                <a href="{{ route('success.page') }}" class="btn btn-primary">I got it</a>
            </div>
        </div>
    </div>
</div>
<br><br><br><br><br>
@endsection
