@props([
    'post'      => false,
])

<style>
    .image-gallery {
        display: block;
    }

    .gallery-item {
        width: 98%;
        height: auto;
        margin-left: auto;
        margin-right: auto;
        margin-top: 20px;
    }

    .gallery-item img {
        width: 98%;
        height: auto;
        margin-left: auto;
        margin-right: auto;
    }
</style>

<div class="image-gallery">
    <div class="gallery-item">
        <img src="{{ asset('storage/'.$post->photo) }}" alt="">
    </div>
</div>
