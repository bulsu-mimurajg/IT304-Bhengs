function printReceipt(){
    var receiptData = document.getElementById("receipt").innerHTML;

    // Create an iframe element dynamically
    var iframe = document.createElement('iframe');
    iframe.style.position = 'absolute';
    iframe.style.width = '0';
    iframe.style.height = '0';
    iframe.style.border = 'none';
    
    // Append the iframe to the body (but keep it hidden)
    document.body.appendChild(iframe);
    
    // Write the receipt content to the iframe's document
    var doc = iframe.contentWindow.document;
    doc.open();
    doc.write('<html><body>');
    doc.write(receiptData);
    doc.write('</body></html>');
    doc.close();
    
    // Print the content of the iframe
    iframe.contentWindow.focus();
    iframe.contentWindow.print();
    
    // Optionally remove the iframe after printing
    setTimeout(function() {
        document.body.removeChild(iframe);
    }, 1000);
}