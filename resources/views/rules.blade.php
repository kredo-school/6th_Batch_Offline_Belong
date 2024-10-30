@extends('layouts.app')

@section('content')
<div class="container-fluid p-0"> <!-- container-fluid に変更して横いっぱいにする -->
    <div class="row justify-content-center">
        <div class="col-md-12"> <!-- 横いっぱいにしたい場合は12カラム使う -->
            <div class="card" style="margin-top: -1px;"> <!-- マージンを調整 -->
                <div class="card-header p-0 position-relative"> <!-- p-0で余白をなくし、position-relative で子要素のabsoluteを扱う -->
                    <img src="{{ asset('images/rule.jpg') }}" alt="homeimage" style="width:100%; height:500px; object-fit:cover;"> <!-- 高さ500pxで幅を自動調整 -->
                    <div class="overlay-text"> <!-- テキストを追加 -->
                        Please strictly follow the rules.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 中央に配置されたテキストセクション -->
    <div class="row justify-content-center mt-5"> <!-- マージンを増やしてスペースを広げる -->
        <div class="col-md-6 text-center"> <!-- テキストのカラムを狭くする -->
            <h1>Terms of Service</h1>
            <br>
            <p style="line-height: 1.6; text-align: left;"> <!-- 行間を調整し、左揃えにする -->
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Debitis accusamus illo obcaecati quasi voluptate. Inventore id sit, aspernatur laboriosam laborum tenetur, deleniti saepe obcaecati pariatur fugit autem asperiores atque doloribus dolorum at. Vel magnam eveniet amet sequi voluptatum nobis natus! Fuga aut explicabo omnis voluptatum quas nihil ex, reiciendis facere doloremque nemo id quae optio iste. Earum sed sequi, debitis nisi deserunt sint minima dolorem veniam ratione adipisci ea. Placeat ullam, facilis alias officia minima nostrum ducimus incidunt eum libero ex corrupti dolor similique odio, officiis pariatur aliquid distinctio vero commodi atque tempora perferendis vitae porro? Nam explicabo expedita eaque ipsa enim sequi ut qui ea libero earum ipsum cumque consequuntur, itaque eveniet, dolore nihil atque recusandae sit assumenda natus rem, reprehenderit ad dolores. Architecto corporis, qui repellendus quam porro magnam beatae voluptates quod aperiam, iure, blanditiis illo. Incidunt a temporibus consequatur. Odit cum quia eius corporis blanditiis animi. Sed accusantium dignissimos deleniti corporis magnam possimus ipsum et consequuntur id, maiores doloremque pariatur inventore aperiam eum, facilis sapiente unde earum dolore temporibus, tempora culpa accusamus! Nulla nostrum nihil harum, soluta vitae velit vero quos natus tenetur unde mollitia! Unde veritatis error id recusandae natus assumenda quisquam enim totam autem quae provident qui quam tenetur dolore, soluta distinctio sapiente? Perspiciatis eius itaque incidunt praesentium inventore, officiis, ratione sed cumque eaque iste exercitationem, atque accusamus minima. Inventore porro eius officiis iste, dolore odio iusto deleniti atque autem ratione accusantium molestiae quia cumque? Ipsam libero, aliquam minus numquam soluta exercitationem cupiditate, odio fugiat pariatur eius quae. Dolore consequatur incidunt rerum ea, minima laudantium fuga quo suscipit atque, quasi officia nihil corrupti veritatis dolores amet facilis velit esse blanditiis ipsum nemo quaerat et. Mollitia vitae nisi corporis facere accusamus aliquam magnam, iste quos quibusdam adipisci dolor ratione molestiae nulla soluta voluptas harum ex rem natus beatae commodi sunt reiciendis minima incidunt quisquam. Aliquid molestias recusandae rem odio nam, magni error voluptatum ratione, repudiandae maiores sit consequuntur facere nostrum soluta eum qui eos eveniet hic ducimus veritatis voluptate. Ex deleniti veritatis consequuntur, aliquam vitae nihil dolorum fuga, eius delectus ipsa odio commodi necessitatibus repellat tenetur, eaque eum enim magni eveniet iusto dignissimos architecto! Voluptatem cum aut modi ipsum minima, saepe iste possimus dolorem, accusantium libero expedita pariatur nemo. Dicta molestiae in saepe? Aspernatur suscipit, unde aliquid vero veniam fugiat tempora sapiente, quos nihil maxime iusto itaque, dolorem odit facilis ut. Vero expedita id eos, necessitatibus quia est officiis pariatur quo numquam at iste adipisci error itaque, harum eaque veniam enim velit et corporis, nesciunt officia? Sequi nulla doloribus fugiat deleniti officiis voluptates eaque est pariatur consequatur harum fuga aliquam magnam, placeat velit quod ad exercitationem facere dolor itaque iste laboriosam! Aperiam quas officia illo modi nam minus architecto recusandae, illum maxime exercitationem rem, nostrum, deserunt expedita neque perspiciatis obcaecati. Perspiciatis, officia. Unde sequi necessitatibus voluptate harum, at amet sunt natus expedita adipisci dolor aut quos repellendus quibusdam enim culpa quasi voluptatibus consequatur iusto accusantium dignissimos nulla obcaecati. Assumenda quod autem eos minus. Quaerat, ipsam eaque?
            </p>
            <br>

            <!-- サクセスページに戻るボタン -->
            <a href="{{ route('success.page') }}" class="btn btn-primary">I got it</a>
        </div>
    </div>
    <br>
    <br>
</div>

<style>
    .overlay-text {
        position: absolute; /* 画像の上に配置 */
        top: 50%; /* 垂直中央 */
        left: 50%; /* 水平中央 */
        transform: translate(-50%, -50%); /* 中心に調整 */
        color: white; /* テキストの色 */
        font-weight: bold; /* 太字 */
        font-size: 46px; /* フォントサイズ */
        text-align: center; /* テキストの中央揃え */
    }
</style>

@endsection
