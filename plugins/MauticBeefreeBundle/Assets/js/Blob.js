/* @source http://purl.eligrey.com/github/Blob.js/blob/master/Blob.js */
(function(d) {
    d.URL = d.URL || d.webkitURL;
    if (d.Blob && d.URL) try {
        new Blob;
        return
    } catch (b) {}
    var p = d.BlobBuilder || d.WebKitBlobBuilder || d.MozBlobBuilder || function(b) {
        var d = function(a) {
                return Object.prototype.toString.call(a).match(/^\[object\s(.*)\]$/)[1]
            },
            e = function() {
                this.data = []
            },
            g = function(a, c, b) {
                this.data = a;
                this.size = a.length;
                this.type = c;
                this.encoding = b
            },
            f = e.prototype,
            h = g.prototype,
            q = b.FileReaderSync,
            r = function(a) {
                this.code = this[this.name = a]
            },
            t = "NOT_FOUND_ERR SECURITY_ERR ABORT_ERR NOT_READABLE_ERR ENCODING_ERR NO_MODIFICATION_ALLOWED_ERR INVALID_STATE_ERR SYNTAX_ERR".split(" "),
            l = t.length,
            k = b.URL || b.webkitURL || b,
            u = k.createObjectURL,
            v = k.revokeObjectURL,
            m = k,
            w = b.btoa,
            x = b.atob,
            p = b.ArrayBuffer,
            n = b.Uint8Array,
            y = /^[\w-]+:\/*\[?[\w\.:-]+\]?(?::[0-9]+)?/;
        for (g.fake = h.fake = !0; l--;) r.prototype[t[l]] = l + 1;
        k.createObjectURL || (m = b.URL = function(a) {
            var c = document.createElementNS("http://www.w3.org/1999/xhtml", "a");
            c.href = a;
            "origin" in c || ("data:" === c.protocol.toLowerCase() ? c.origin = null : (a = a.match(y), c.origin = a && a[1]));
            return c
        });
        m.createObjectURL = function(a) {
            var c = a.type;
            null === c && (c = "application/octet-stream");
            if (a instanceof g) return c = "data:" + c, "base64" === a.encoding ? c + ";base64," + a.data : "URI" === a.encoding ? c + "," + decodeURIComponent(a.data) : w ? c + ";base64," + w(a.data) : c + "," + encodeURIComponent(a.data);
            if (u) return u.call(k, a)
        };
        m.revokeObjectURL = function(a) {
            "data:" !== a.substring(0, 5) && v && v.call(k, a)
        };
        f.append = function(a) {
            var c = this.data;
            if (n && (a instanceof p || a instanceof n)) {
                var b = "";
                a = new n(a);
                for (var e = 0, f = a.length; e < f; e++) b += String.fromCharCode(a[e]);
                c.push(b)
            } else if ("Blob" === d(a) || "File" === d(a))
                if (q) b = new q,
                    c.push(b.readAsBinaryString(a));
                else throw new r("NOT_READABLE_ERR");
            else a instanceof g ? "base64" === a.encoding && x ? c.push(x(a.data)) : "URI" === a.encoding ? c.push(decodeURIComponent(a.data)) : "raw" === a.encoding && c.push(a.data) : ("string" !== typeof a && (a += ""), c.push(unescape(encodeURIComponent(a))))
        };
        f.getBlob = function(a) {
            arguments.length || (a = null);
            return new g(this.data.join(""), a, "raw")
        };
        f.toString = function() {
            return "[object BlobBuilder]"
        };
        h.slice = function(a, c, b) {
            var d = arguments.length;
            3 > d && (b = null);
            return new g(this.data.slice(a,
                1 < d ? c : this.data.length), b, this.encoding)
        };
        h.toString = function() {
            return "[object Blob]"
        };
        h.close = function() {
            this.size = 0;
            delete this.data
        };
        return e
    }(d);
    d.Blob = function(b, d) {
        var e = d ? d.type || "" : "",
            g = new p;
        if (b)
            for (var f = 0, h = b.length; f < h; f++) Uint8Array && b[f] instanceof Uint8Array ? g.append(b[f].buffer) : g.append(b[f]);
        e = g.getBlob(e);
        !e.slice && e.webkitSlice && (e.slice = e.webkitSlice);
        return e
    };
    d.Blob.prototype = (Object.getPrototypeOf || function(b) {
        return b.__proto__
    })(new d.Blob)
})("undefined" !== typeof self && self ||
    "undefined" !== typeof window && window || this);
