class Modals {

    constructor(options) {
        this.init();
    }

    init() {
        this.#setup();
    }

    static modalClass = 'modal';
    static modalOpenClass = 'modal--open';
    static modalShowClass = 'modal--show';

    #setup() {
        this.$modals = Array.from(document.getElementsByClassName(Modals.modalClass));
        this.modalsArray = new Map();
        this.$modals.forEach(($modal) => {
            let background = '<div class="modal__background" data-modal-close></div>';
            $modal.insertAdjacentHTML('afterbegin', background);
            this.modalsArray.set($modal.id, $modal);
        });

        this.$openButtons = document.querySelectorAll('[data-modal-open]');
        this.$closeButtons = document.querySelectorAll('[data-modal-close]');

        this.clickOpenHandler = this.clickOpenHandler.bind(this);
        this.clickCloseHandler = this.clickCloseHandler.bind(this);
        this.$openButtons.forEach(($button) => {
            $button.addEventListener('click', this.clickOpenHandler);
        });

        this.$closeButtons.forEach(($button) => {
            $button.addEventListener('click', this.clickCloseHandler);
        });
    }

    clickOpenHandler(event) {
        if (event.target.dataset.modalOpen) {
            this.open(event.target.dataset.modalOpen);
        } else {
            this.open(event.target.closest('[data-modal-open]').dataset.modalOpen);
        }


    }

    clickCloseHandler() {
        this.close();
    }

    open(id) {
        this.setCenter(id);
        this.modalsArray.get(id).classList.add(Modals.modalShowClass);
    }

    close() {

        this.$modals.forEach(($modal) => {
            $modal.classList.remove(Modals.modalOpenClass);
        });
    }

    setCenter(id) {
        this.modalsArray.get(id).classList.add(Modals.modalOpenClass);
        let modalHeight = this.modalsArray.get(id).offsetHeight;
        let viewportHeight = window.viewportOptions.viewportHeight;
        let top = (viewportHeight / 2) - (modalHeight / 2);
        this.modalsArray.get(id).style.top = top + 'px';
    }

}


window.modals = new Modals();