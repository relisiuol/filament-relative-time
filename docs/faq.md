# FAQ

**Q. Why not auto-register the asset without publishing?**  
A. The safest approach (CSP/CDN) is to **publish** the asset to `public/` and serve it from your domain.

**Q. How do I support a per-user time zone?**  
A. Detect on the client and persist (session/profile). Set `time-zone="Europe/Paris"` on `<html>` via the plugin or a render hook.

**Q. Do sorting/filters remain consistent?**  
A. Yes. The column does not alter server values (UTC). Rendering is client-side via the Web Component.
