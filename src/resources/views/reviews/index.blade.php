<div id="review-list">
    @foreach ($reviews as $review)
        @include('reviews.partials.review', ['review' => $review])
    @endforeach
</div>
