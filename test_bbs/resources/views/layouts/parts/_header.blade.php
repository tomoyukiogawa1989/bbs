<!-- Header -->
    <header>
    </header>
    <!-- content -->
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">Menu</div>
                <!-- <div class="panel-body"> -->
                <div class="panel-body" id="accordion">

                  <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="collapseListGroupHeading1">
                      <h4 class="panel-title">
                        <a class="" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseListGroup1" aria-expanded="true" aria-controls="collapseListGroup1">
                          マイページ
                        </a>
                      </h4>
                    </div>
                    <div id="collapseListGroup1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="collapseListGroupHeading1" aria-expanded="true">
                      <ul class="list-group">
                        <li class="list-group-item"><a href="{{ url('/mypage/profile') }}">プロフィール編集</a></li>
                        <li class="list-group-item"><a href="{{ url('/bbs/myviews') }}">投稿した記事</a></li>
                      </ul>
                    </div>
                  </div>

                  <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="collapseListGroupHeading2">
                      <h4 class="panel-title">
                        <a class="" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseListGroup2" aria-expanded="true" aria-controls="collapseListGroup2">
                          掲示板
                        </a>
                      </h4>
                    </div>
                    <div id="collapseListGroup2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="collapseListGroupHeading2" aria-expanded="true">
                      <ul class="list-group">
                        <li class="list-group-item"><a href="{{ url('/bbs/create/') }}">記事作成</a></li>
                        <li class="list-group-item"><a href="{{ url('/bbs/views/') }}">記事一覧</a></li>
                      </ul>
                    </div>
                  </div>

                  <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="collapseListGroupHeading3">
                      <h4 class="panel-title">
                        <a class="" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseListGroup3" aria-expanded="true" aria-controls="collapseListGroup3">
                          その他
                        </a>
                      </h4>
                    </div>
                    <div id="collapseListGroup3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="collapseListGroupHeading3" aria-expanded="true">
                      <ul class="list-group">
                        <li class="list-group-item">利用規約</li>
                        <li class="list-group-item">ヘルプ</li>
                        <li class="list-group-item">退会</li>
                      </ul>
                    </div>
                  </div>

                </div> 
                <!-- </div class="panel-body"> -->
            </div>
        </div>