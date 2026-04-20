function onDiseaseChange(currentSelect) {
    document.querySelectorAll('select[name="disease"]').forEach(sel => {
        if (sel !== currentSelect) {
            sel.selectedIndex = 0;
        }
    });
    currentSelect.form.submit();
}