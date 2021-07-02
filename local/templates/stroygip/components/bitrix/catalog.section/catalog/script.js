class ProductListPage {
    constructor() {
        this.bind();
    }

    bind() {
        $('.catalog-sort__select').on('change', this.onSortChange.bind(this));
        $('.catalog-page-size__select').on('change', this.onPageSizeChange.bind(this));
    }

    onSortChange(e) {
        const $el = $(e.currentTarget);
        const sort = $el.val();

        const url = new URL(document.location.href);
        url.searchParams.append('sort', sort);
        document.location.href = url.toString();
    }

    onPageSizeChange(e) {
        const $el = $(e.currentTarget);
        const pageSize = $el.val();

        const url = new URL(document.location.href);
        url.searchParams.append('pageSize', pageSize);
        document.location.href = url.toString();
    }
}

$(() => { window.controller = new ProductListPage(); });