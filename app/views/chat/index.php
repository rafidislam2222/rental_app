<div style="max-width:600px; margin:40px auto; padding:0; background:#fff; border:1px solid #e0e0e0; border-radius:16px; box-shadow:0 4px 24px rgba(0,0,0,0.08); font-family:'Segoe UI',Arial,sans-serif;">
    <div style="background:linear-gradient(90deg,#4f8cff 0%,#38c6d9 100%); border-radius:16px 16px 0 0; padding:24px 32px;">
        <h2 style="margin:0; color:#fff; font-weight:600; letter-spacing:1px; font-size:1.6rem; display:flex; align-items:center;">
            <span style="font-size:2rem; margin-right:10px;">🤖</span> Booking Assistant
        </h2>
    </div>

    <div style="min-height:220px; border-bottom:1px solid #f0f0f0; padding:24px 32px 16px 32px; background:#f9fbfd;">
        <?php if (!empty($data['question'])): ?>
            <div style="margin-bottom:16px;">
                <span style="display:inline-block; background:#e3f0ff; color:#2563eb; padding:10px 18px; border-radius:18px 18px 4px 18px; font-weight:500; box-shadow:0 1px 4px rgba(79,140,255,0.07);">
                    You: <?= nl2br(htmlspecialchars($data['question'])) ?>
                </span>
            </div>
        <?php endif; ?>

        <?php if (!empty($data['answer'])): ?>
            <div>
                <span style="display:inline-block; background:#e6f9f7; color:#059669; padding:10px 18px; border-radius:18px 18px 18px 4px; font-weight:500; box-shadow:0 1px 4px rgba(56,198,217,0.07);">
                    Assistant: <?= nl2br(htmlspecialchars($data['answer'])) ?>
                </span>
            </div>
        <?php endif; ?>
    </div>

    <form method="POST" action="/rental_system/public/index.php?url=ChatController/ask" style="display:flex; align-items:center; padding:20px 32px;">
        <input type="text" name="question" style="flex:1; padding:12px 16px; border:1px solid #d1d5db; border-radius:8px; font-size:1rem; margin-right:12px; transition:border-color 0.2s;" required placeholder="Type your question...">
        <button type="submit" style="background:linear-gradient(90deg,#4f8cff 0%,#38c6d9 100%); color:#fff; border:none; border-radius:8px; padding:12px 28px; font-size:1rem; font-weight:600; cursor:pointer; box-shadow:0 2px 8px rgba(79,140,255,0.08); transition:background 0.2s;">
            Send
        </button>
    </form>
</div>
