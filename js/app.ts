if (document.querySelector('.archive-header')) {
    const self: any = document.querySelector('.archive-header');
    const id = self.dataset.id;
    fetch(`/api/archive/${id}`);
}
//@ts-ignore
if (obvInit.is_single) {
    //@ts-ignore
    const id = obvInit.post_id;
    fetch(`/api/single/${id}`);
}

class farallonBase {
    constructor() {}
}

new farallonBase();
