<section class="bg-blog-style-2">
    <div class="container">
        <div class="row">
            <div class="blog-style-2">
                <div class="row">
                    <div class="col-md-8">
                        <?php if (!empty($berita)): ?>
                                <?php if (isset($search_keyword) && $search_keyword != ''): ?>
                                    <h2><?php echo lang_text('Hasil Pencarian', 'Search Results'); ?>: <span style="color:#faa441"><?= htmlspecialchars($search_keyword) ?></span></h2>
                                <?php endif; ?>
                                <?php foreach ($berita as $item) { ?>
                                <div class="blog-items">
                                    <div class="blog-img" style="width:770px;height:370px;">
                                        <a href="<?php echo base_url('berita/read/' . $item->slug_berita); ?>"><img
                                                src="<?php echo base_url('assets/upload/image/' . $item->gambar) ?>"
                                                alt="blog-img-10" class="img-responsive" /></a>
                                    </div>
                                    <div class="blog-content-box">
                                        <div class="blog-content">  
                                            <h4><a
                                                    href="<?php echo base_url('berita/read/' . $item->slug_berita); ?>"><?php echo smart_translate($item->judul_berita, 'berita_list_title_'.$item->id_berita, 120); ?></a>
                                            </h4>
                                            <ul class="meta-post">
                                                <li><i class="fa fa-calendar" aria-hidden="true"></i>
                                                    <?php echo date('d M Y', strtotime($item->tanggal_publish)); ?></li>
                                                <li><i class="fa fa-user"></i> <?php echo $item->nama; ?></li>
                                            </ul>
                                            <p class="text-justify">
                                                <?php echo smart_translate($item->isi, 'berita_list_content_'.$item->id_berita, 180); ?>
                                            </p>
                                            <a href="<?php echo base_url('berita/read/' . $item->slug_berita); ?>"><i
                                                    class="fa fa-chevron-right"></i> <?php echo lang_text('Selengkapnya', 'Read More'); ?></a>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php else: ?>
                            <?php if (isset($search_keyword) && $search_keyword != ''): ?>
                                <h2><?php echo lang_text('Hasil Pencarian', 'Search Results'); ?>: <span
                                style="color:#faa441"><?= htmlspecialchars($search_keyword) ?></span></h2>
                                <p style="font-size: 1.5rem;"><?php echo lang_text('Tidak ada hasil untuk pencarian dengan kata kunci', 'No results found for search keyword'); ?><strong> <?= htmlspecialchars($search_keyword) ?></strong>.<br><?php echo lang_text('Silakan coba lagi dengan kata kunci yang berbeda.', 'Please try again with different keywords.'); ?></p>
                                <?php endif; ?>
                        <?php endif ?>
                        <div class="pagination-option">
                            <nav aria-label="Page navigation">
                                <?php if (isset($pagin)) {
                                    echo $pagin;
                                } ?>
                                <!-- <ul class="pagination">
                                            <li>
                                                <a href="#" aria-label="Previous">
                                                    <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                                                </a>
                                            </li>
                                            <li><a href="#">1</a></li>
                                            <li class="active"><a href="#">2</a></li>
                                            <li><a href="#">3</a></li>
                                            <li><a href="#">...</a></li>
                                            <li><a href="#">5</a></li>
                                            <li>
                                                <a href="#" aria-label="Next">
                                                    <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                                </a>
                                            </li>
                                        </ul> -->
                            </nav>
                        </div>
                        <!-- .pagination_option -->
                    </div>
                    <!-- .col-md-8 -->
                    <div class="col-md-4">
                        <div class="sidebar">
                            <div class="widget">
                                <h4 class="sidebar-widget-title"><?php echo lang_text('Berita Terpopuler', 'Popular News'); ?></h4>
                                <div class="widget-content">
                                    <ul class="popular-news-option">
                                        <?php foreach ($populer as $populer) { ?>
                                            <li>
                                                <div class="popular-news-img" style="width: 80px; height: 80px;">
                                                    <a href="#"><img src="<?php if ($populer->gambar == "") {
                                                        echo base_url('assets/upload/image/thumbs/' . $site->icon);
                                                    } else {
                                                        echo base_url('assets/upload/image/thumbs/' . $populer->gambar);
                                                    } ?>" alt="popular-news-img-1" /></a>
                                                </div>
                                                <!-- .popular-news-img -->
                                                <div class="popular-news-contant">
                                                    <h5><a
                                                            href="<?php echo base_url('berita/read/' . $populer->slug_berita); ?>"><?php echo smart_translate($populer->judul_berita, 'popular_title_'.$populer->id_berita, 80); ?></a>
                                                    </h5>
                                                    <p>
                                                        <i class="fa fa-calendar"></i>
                                                        <?php echo date('d M Y', strtotime($populer->tanggal_publish)); ?>
                                                        <a href="#"><i class="fa fa-eye" aria-hidden="true"></i>
                                                            <?php echo $populer->hits; ?> <?php echo lang_text('Viewer', 'Views'); ?></a>
                                                    </p>
                                                </div>
                                                <!-- .popular-news-img -->
                                            </li>
                                        <?php } ?>
                                    </ul>

                                </div>
                                <!-- .widget-content -->
                            </div>
                        </div>
                        <!-- .sidebar -->
                    </div>
                    <!-- .col-md-4 -->
                </div>
                <!-- .row -->
            </div>
            <!-- .blog-style-2 -->
        </div>
        <!-- .row -->
    </div>
    <!-- .container -->
</section>