@extends('templates/app')

@section('header')
    @include('post/partials/image', [
        'url' => asset('img/coding.jpeg')
    ])
@endsection

@section('main')
    <article class="article">
        <div class="author">
            <img src="https://ucarecdn.com/75ad47d5-c5d1-4c0b-a0a7-4690c27fc435/" alt="Alex Garrett" class="author__image">
            <div class="author__details">
                <a href="" class="author__name">Alex Garrett</a>
                <div class="author__post-time">5 days ago</div>
            </div>
        </div>

        <h1 class="article__header">Should you learn to code?</h1>
        <h2 class="article__subheader">Bear claw sweet roll chocolate. Lollipop cake candy macaroon danish. Icing marzipan macaroon cotton candy sweet roll.</h2>
        <div class="article__body">
            <p>Bear claw sweet roll chocolate. Lollipop cake candy macaroon danish. Icing marzipan macaroon cotton candy sweet roll lollipop bonbon caramels sweet roll. Gummies brownie pudding. Tart bonbon sweet wafer cookie candy canes sweet dessert dragée. Caramels halvah cheesecake. Chocolate cake cake cupcake brownie. Gummies pudding tiramisu pie liquorice sesame snaps cupcake chocolate bar apple pie. Powder jelly chocolate liquorice marzipan. Tart wafer biscuit chupa chups. Bonbon topping tootsie roll croissant topping. Candy cotton candy tiramisu carrot cake jelly cake ice cream caramels topping.</p>
            <p>Cookie jelly beans biscuit tootsie roll. Wafer cake pudding dragée donut croissant jujubes chocolate bar pie. Apple pie bear claw donut danish cookie biscuit dessert lemon drops. Pastry jelly-o wafer danish toffee. Chocolate bar candy canes apple pie muffin marzipan cookie sweet oat cake. Tart soufflé soufflé sweet roll icing sweet gingerbread sweet roll. Sugar plum dessert chupa chups. Macaroon chocolate cake candy canes candy topping. Marzipan soufflé apple pie soufflé cake wafer tiramisu. Chupa chups soufflé powder sesame snaps.</p>
            <p>Dessert candy cotton candy. Gingerbread jelly beans caramels. Croissant sesame snaps cake muffin liquorice donut gummies chupa chups. Cupcake danish chocolate cake. Cake sesame snaps pudding cupcake jujubes. Caramels pudding dessert sweet roll dragée jelly caramels jelly beans. Cheesecake donut tart toffee icing tootsie roll tootsie roll. Soufflé jujubes sesame snaps bonbon candy canes cupcake carrot cake. Jelly-o cookie pie tootsie roll jelly-o danish cotton candy. Powder tiramisu cake. Gummi bears pastry sweet. Croissant tiramisu topping danish tiramisu chocolate sugar plum muffin gummi bears.</p>
        </div>

        <a href="#" class="tag">Coding</a>
        <a href="#" class="tag">Education</a>
    </article>
@endsection
