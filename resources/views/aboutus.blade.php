@extends('layouts.app')     

@section('content')

<head>
    <!-- 他の<head>要素 -->
    <link href="https://fonts.googleapis.com/css2?family=Patrick+Hand&display=swap" rel="stylesheet">
</head>

<div class="container-fluid p-0"> <!-- container-fluid に変更して横いっぱいにする -->
    <div class="row justify-content-center">
        <div class="col-md-12"> <!-- 横いっぱいにしたい場合は12カラム使う -->
            <div class="card" style="margin-top: -1px;"> <!-- マージンを調整 -->
                <div class="card-header p-0 position-relative"> <!-- p-0で余白をなくし、position-relative で子要素のabsoluteを扱う -->
                    <img src="{{ asset('images/about.jpg') }}" alt="homeimage" style="width:100%; height:500px; object-fit:cover;"> <!-- 高さ500pxで幅を自動調整 -->
                </div>
            </div>
        </div>
    </div>

    <!-- 中央に配置されたテキストセクション -->
    <div class="row justify-content-center mt-5"> <!-- マージンを増やしてスペースを広げる -->
        <div class="col-md-6 text-center"> <!-- テキストのカラムを狭くする -->
            <h1>About Us</h1>
            <br>
            <p style="line-height: 1.6; text-align: left;"> <!-- 行間を調整し、左揃えにする -->
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores praesentium ducimus rem aperiam nesciunt ad exercitationem fuga? Unde voluptatibus deleniti nulla esse veniam laboriosam alias, fuga omnis deserunt voluptatem. Obcaecati ullam accusamus cumque repudiandae esse maxime alias ea aperiam ex quia doloribus quos voluptates soluta commodi labore impedit quasi non autem, hic nobis expedita pariatur, explicabo, tempora porro. Nulla commodi minus id possimus quod iste quas illo voluptatum sit odio! Magni, tenetur, voluptas fugit eum tempore ullam soluta adipisci atque consequuntur quis quibusdam ipsa ipsum aut earum sunt placeat nam, quas harum aspernatur fuga. Rem ipsam modi aliquam veniam quos qui provident quidem id error labore praesentium laboriosam quibusdam esse fuga vero, commodi facilis, rerum magnam corrupti molestias earum, nemo asperiores? Voluptas molestiae impedit eveniet optio totam vitae assumenda ullam repellendus necessitatibus quisquam, quod consectetur, repudiandae officia quidem architecto similique, id earum! Minima beatae ipsum nam sunt vero! Odio praesentium adipisci, impedit sapiente voluptates sequi fugit quasi quae vitae, doloremque dicta autem libero amet modi quas sint fugiat. Consequatur earum et dolorum, id magnam quibusdam at, provident numquam mollitia saepe culpa fugit placeat iusto laboriosam esse neque quis sequi omnis itaque ipsam obcaecati nulla quasi fuga! Quasi magnam dolore laudantium illum dignissimos. Aspernatur cumque incidunt ut placeat suscipit voluptatibus totam laboriosam dolor magnam aut est nisi, omnis nostrum molestiae fuga atque. Harum iure assumenda eligendi consectetur laboriosam dolores architecto nesciunt rerum ex eos voluptatibus, quis perferendis! Eligendi amet enim quos accusantium voluptatem consequuntur ad modi unde quis ex dignissimos atque nobis nulla, eveniet harum deserunt saepe sapiente. Officiis quo veniam alias unde dolor fugiat reprehenderit repudiandae voluptatem praesentium cum excepturi, a quisquam sapiente provident laudantium nam? Esse numquam totam aut vitae, sequi officiis eum facilis quod explicabo soluta distinctio unde voluptas placeat culpa necessitatibus quae fugiat adipisci voluptatibus accusamus! Distinctio nobis ad eaque quidem iure iste, dolorum sunt praesentium numquam ipsa ullam, blanditiis, adipisci temporibus sed tempore illo maxime beatae? Quibusdam ea totam nemo asperiores nesciunt quisquam, explicabo aut tenetur ad inventore ducimus officiis voluptatibus, repudiandae cupiditate esse! Corporis quaerat provident obcaecati sit ea, repellat minus dolores dolorem quo commodi sed eum distinctio ad libero itaque, animi perspiciatis. Exercitationem quibusdam ratione inventore fugiat nesciunt cumque ipsa porro et dignissimos ea rerum fuga, nobis eos doloribus, qui omnis eligendi alias minus consequatur voluptas aliquam corrupti quis assumenda? Laborum quae eum sed illum iure repudiandae corporis culpa, doloremque rerum ea ipsum, odio optio distinctio cum, facere alias quis. Obcaecati laboriosam neque recusandae quas est tempore temporibus autem accusantium commodi culpa, quos natus voluptates architecto nemo porro incidunt veritatis? Sapiente suscipit quod repellat optio blanditiis voluptatem praesentium explicabo a rem, incidunt laboriosam, quam neque nihil non voluptate accusantium. Soluta in excepturi quaerat aliquid, enim beatae eaque, ipsa, expedita inventore hic eos! Voluptatibus vero distinctio magni asperiores perferendis mollitia dolor, neque reiciendis facere, ullam nostrum accusamus quas quod autem vitae eum illum laborum similique inventore sint nisi! Quae totam vero iusto asperiores dolores, ab nobis dignissimos inventore officiis quos eaque qui iure quas veniam.
            </p>
            <br>
            <div class="d-flex justify-content-between"> <!-- Flexboxを使用して横並びに配置 -->
                <h3 class="text-start">Thank you very much!!</h3> <!-- 左寄せ -->
                <h1 class="text-end" style="font-family: 'Patrick Hand', cursive; font-style: italic;">Kurt John</h1> <!-- 右寄せと手書き風フォント -->
            </div>

        </div>
    </div>
    <br>
    <br>
</div>
@endsection
