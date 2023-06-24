if (document.querySelector('.archive-header')) {
    const self: any = document.querySelector('.archive-header');
    const id = self.dataset.id;
    fetch(`/api/archive/${id}`);
}
