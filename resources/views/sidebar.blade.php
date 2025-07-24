<div class="card mb-4">
    <div class="card-body nav-control py-3 px-1">
        <ul class="nav flex-column">
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt mr-1"></i> Bảng điều khiển</a>
            </li>
            <li class="dropdown-divider"></li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('orders.create') }}"><i class="fas fa-store mr-1"></i> Quản lý bán hàng</a>
            </li>
            @if (Auth::user() && Auth::user()->role->code == 'admin')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('product.view') }}"><i class="fab fa-product-hunt mr-1"></i> Quản lý sản phẩm</a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center" href="{{ route('category.view') }}" title="Quản lý danh mục">
                    <svg fill="#009dd9" height="" width="20px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 256 256" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M173,44.5v14.2H84.8V44.5h-33v194.3H206V44.5H173z M90.5,188.7c-6.1,0-11-4.9-11-11c0-6.1,4.9-11,11-11c6.1,0,11,4.9,11,11 C101.5,183.7,96.6,188.7,90.5,188.7z M90.5,151.8c-6.1,0-11-4.9-11-11c0-6.1,4.9-11,11-11c6.1,0,11,4.9,11,11 C101.5,146.9,96.6,151.8,90.5,151.8z M90.5,115c-6.1,0-11-4.9-11-11s4.9-11,11-11c6.1,0,11,4.9,11,11S96.6,115,90.5,115z M178.3,186.1h-65.5v-16.8h65.5V186.1z M178.3,149.2h-65.5v-16.8h65.5V149.2z M178.3,112.4h-65.5V95.6h65.5V112.4z"></path> <g> <path d="M140.9,32.4c-0.2-6.5-5.5-11.7-12-11.7c-6.5,0-11.8,5.2-12,11.7H93.1v19.9h71.5V32.4H140.9z M128.9,38.2 c-3,0-5.5-2.5-5.5-5.5c0-0.1,0-0.2,0-0.3c0.2-2.9,2.6-5.2,5.5-5.2c2.9,0,5.3,2.3,5.5,5.2c0,0.1,0,0.2,0,0.3 C134.4,35.7,131.9,38.2,128.9,38.2z"></path> </g> </g> </g></svg>
                    <span class="ml-1">Quản lý danh mục</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('supplier.view') }}"><i class="fas fa-industry mr-1"></i> Quản lý nhà sản xuất</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('orders.index') }}"><i class="fas fa-cart-plus mr-1"></i> Quản lý đơn hàng</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('imports.index') }}"><i class="fas fa-file-import mr-1"></i> Quản lý nhập hàng</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('employee.view') }}"><i class="fas fa-users mr-1"></i> Quản lý nhân viên</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.view') }}"><i class="fas fa-user mr-1"></i> Quản lý tài khoản</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('reports.index') }}"><i class="fas fa-book mr-1"></i> Thống kê, báo cáo</a>
            </li>
            @endif
        </ul>
    </div>
</div>