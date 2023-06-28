class farallonBase {
    is_single: boolean = false;
    post_id: number = 0;
    is_archive: boolean = false;
    constructor() {
        //@ts-ignore
        this.is_single = obvInit.is_single;
        //@ts-ignore
        this.post_id = obvInit.post_id;
        //@ts-ignore
        this.is_archive = obvInit.is_archive;

        if (this.is_single) {
            this.trackPostView();
        }

        if (this.is_archive) {
            this.trackArchiveView();
        }
    }

    getCookie(t: any) {
        if (0 < document.cookie.length) {
            var e = document.cookie.indexOf(t + '=');
            if (-1 != e) {
                e = e + t.length + 1;
                var n = document.cookie.indexOf(';', e);
                return -1 == n && (n = document.cookie.length), document.cookie.substring(e, n);
            }
        }
        return '';
    }

    setCookie(t: any, e: any, n: any) {
        var o = new Date();
        o.setTime(o.getTime() + 24 * n * 60 * 60 * 1e3);
        var i = 'expires=' + o.toUTCString();
        document.cookie = t + '=' + e + ';' + i + ';path=/';
    }

    trackPostView() {
        //@ts-ignore
        const id = obvInit.post_id;
        //@ts-ignore

        const url = obvInit.restfulBase + 'farallon/v1/post/view';
        fetch(url, {
            method: 'POST',
            body: JSON.stringify({
                id,
            }),
        });
    }

    trackArchiveView() {
        if (document.querySelector('.archive-header')) {
            const self: any = document.querySelector('.archive-header');
            const id = self.dataset.id;
            fetch(`/api/archive/${id}`);
        }
    }
}

new farallonBase();
