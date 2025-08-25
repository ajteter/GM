<script language="javascript">var PageType ="{{NEW_GAME_PAGE}}"; var ids ="{{NEW_GAME_IDS}}";</script>

<div class="home-search-container blog-page">
    <a href="/" class="logo-home hide-text" aria-label="home">
        Home
    </a>
    <div class="home-search">
        <a href="/" class="home-icon">
            <i class="fa fa-home" aria-hidden="true"></i>
        </a>
        <div id="search" class="home-icon">
            <i class="fa fa-search" aria-hidden="true"></i>
        </div>
    </div>
</div>
<div id="search-left">
    <div class="search-container">
        <div id="search-left-close">
            <i class="fa fa-chevron-left" aria-hidden="true"></i>
        </div>
        <div class="search-form">
            <form id="search-data-form" onsubmit="return false;">
                <img src="/templates/poki-like/image/poki-circle-logo.png" class="poki-circle-logo" alt="poki-circle-logo">
                <div class="divider"></div>
                <input type="text" class="txt fn-left search-input" id="Search-InArea" name="search_parameter" type="text" placeholder="What are you playing today?">
                <input type="submit" class="btn" value="" id="search" aria-label="search-button">
                <div id="clear-search">
                    <i class="fa fa-close" aria-hidden="true"></i>
                </div>
            </form>
        </div>
        <div id="search-results" class="search-results games-list">
            <!-- Hasil pencarian akan muncul di sini -->
        </div>
        <div id="tag-and-games-contaner">
            <div class="tag-container">
                <div class="tag-list">
                    {{TAGS_LIST_HOME}}
                </div>
            </div>
            <p class="title">Popular Games</p>
            <div class="games-list">
                {{POPULAR_GAME_LIST}}
            </div>
            <p class="title">Last Played</p>
            <div class="games-list played-games">
                {{GAMES_PLAYED_LEFT}}
            </div>
        </div>
    </div>
</div>

<div id="Gameinner" class="bgs">
    <div class="partners fn-clear">
        <p class="blog-big">BLOG</p>
        {{BLOGS_LIST}}

        <div class="blog-load-more">Load more..</div>
    </div>
</div>

<div class="bottomtext fn-clear" style="padding:20px;background-color:white;margin-top:40px;">
    {{FOOTER_DESCRIPTION}}
</div>
{{FOOTER_CONTENT}}