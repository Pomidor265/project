class MyHeader extends HTMLElement {
    connectedCallback() {
        this.innerHTML = `
        <header class="header">
            <div class="logo-img">
                <img src="/src/icons/icon2.png">
            </div>
            <div class="title">
                <p>Энциклопедия о заболеваниях</p>
            </div>
        </header> `;
    }
};

class MyHeader_Main extends HTMLElement {
    connectedCallback() {
        this.innerHTML = `
        <header class="header">
            <div class="title">
                <p>Энциклопедия о заболеваниях</p>
            </div>
        </header> `;
    }
}
customElements.define("my-header", MyHeader)
customElements.define("my-header-main", MyHeader_Main)