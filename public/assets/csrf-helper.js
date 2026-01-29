document.addEventListener("DOMContentLoaded", function() {

  // ---- 1️⃣ Read token from <meta> ----
  let csrfName = document.querySelector('meta[name="csrf-name"]').getAttribute('content');
  let csrfHash = document.querySelector('meta[name="csrf-hash"]').getAttribute('content');

  // ---- 2️⃣ Update meta + local copy when token changes ----
  function updateCsrf(newHash) {
    csrfHash = newHash;
    document.querySelector('meta[name="csrf-hash"]').setAttribute('content', newHash);
  }

  // ---- 3️⃣ Wrap native fetch() ----
  const _fetch = window.fetch;
  window.fetch = function(resource, config = {}) {
    config.method = (config.method || 'GET').toUpperCase();

    // Only attach token to modifying requests
    if (['POST','PUT','PATCH','DELETE'].includes(config.method)) {
      const form = new URLSearchParams();
      if (config.body instanceof URLSearchParams) {
        // append existing body
        config.body.forEach((v,k)=>form.append(k,v));
      } else if (typeof config.body === 'string') {
        new URLSearchParams(config.body).forEach((v,k)=>form.append(k,v));
      }
      form.append(csrfName, csrfHash);
      config.body = form;
      config.headers = { 'Content-Type': 'application/x-www-form-urlencoded' };
    }

    return _fetch(resource, config).then(res => {
      const newToken = res.headers.get('X-CSRF-TOKEN');
      if (newToken) updateCsrf(newToken);
      return res;
    });
  };

  // ---- 4️⃣ jQuery support (optional) ----
  if (window.jQuery) {
    $.ajaxSetup({
      beforeSend: function(xhr, settings) {
        if (settings.type !== 'GET') {
          if (typeof settings.data === 'string') {
            settings.data += `&${csrfName}=${csrfHash}`;
          } else if (typeof settings.data === 'object') {
            settings.data[csrfName] = csrfHash;
          }
        }
      },
      complete: function(xhr) {
        const newToken = xhr.getResponseHeader('X-CSRF-TOKEN');
        if (newToken) updateCsrf(newToken);
      }
    });
  }

});
