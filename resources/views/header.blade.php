<header id="header" class="fixed-top">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 d-flex align-items-center">
                <a href="#" class="logo-crm" title="logo">Larvel CRM</a>
            </div>
            <div class="col-md-6 d-flex align-items-center">
                <div class="form-search-header">
                    <form action="#" method="get" class="frm-search">
                        <div class="input-group">
                            <select name="id_cate" class="sl_cate">
                                <option value="0" selected>Danh mục</option>
                                <option value="0">Kệ kho hàng</option>
                                <option value="0">Kệ quảng cáo</option>
                                <option value="0">Phụ kiện siêu thị</option>
                            </select>
                            <input type="text" name="search" class="form-control input-frm" value="" placeholder="Nhập từ khóa tìm kiếm...">
                            <button type="submit" class="btn btn-primary btn-submit-search smooth"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4 d-flex align-items-center justify-content-end">
                <div class="menu-right-hd">
                    <ul>
                        <li>
                            <a href="#" class="item-menu smooth" title="">
                                <i class="far fa-bell"></i>
                                <span class="num">0</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="item-menu smooth" title="">
                                <i class="far fa-envelope"></i>
                                <span class="num">0</span>
                            </a>
                        </li>
                        <li class="user-system">
                            <div class="btn-user-sys d-flex align-items-center">
                                <div class="avt-user">
                                    <img src="{{ asset('assets/frontend/images/no_avatar.png') }}" class="img-fluid" alt="No Avata" title="No avarta">
                                </div>
                                <div class="info-user">
                                    <span class="name-sv">Bùi Văn Thiện</span>
                                    <span class="code-sv">Admin</span>
                                </div>
                            </div>
                            <div class="dropdown-content-user">
                                <div class="it1"><a href="#" class="item smooth">Hồ sơ thông tin</a></div>
                                <div class="it1"><a href="#" class="item smooth">Đổi mật khẩu</a></div>
                                <div class="it1"><a href="{{ route('logout') }}" class="item smooth">Đăng xuất</a></div>
                            </div>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</header>