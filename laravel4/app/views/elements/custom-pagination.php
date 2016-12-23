<?php
    $presenter = new Illuminate\Pagination\BootstrapPresenter($paginator);

    $prevUrl = $paginator->getUrl($paginator->getCurrentPage() - 1);

    $nextPage = $paginator->getCurrentPage() + 1;
    if($nextPage > $paginator->getLastPage())
    {
        $nextPage = $paginator->getCurrentPage();
    }
    $nextUrl = $paginator->getUrl($nextPage);

?>
<div class="btn-group">
    <a href="{{ $prevUrl }}" class="btn"><i class="icon icon-chevron-left"></i></a>
    <span class="btn">{{ $paginator->getCurrentPage() }} / {{ $paginator->getLastPage() }}</span>
    <a href="{{ $nextUrl }}" class="btn"><i class="icon icon-chevron-right"></i></a>
</div>