@extends('layouts.app')
@section('content')
    <input type="text" id="scanner-container">
@endsection

@section('qr-script')
    <script>
        
    </script>

    <script>
        const BarcodeScanner = {
            init: function(elementId, onScan) {
                const constraints = {
                    video: { facingMode: 'environment' } // Use the back camera (facingMode: 'environment')
                };

                navigator.mediaDevices.getUserMedia(constraints)
                    .then(stream => {
                        Quagga.init({
                            inputStream: {
                                name: 'Live',
                                type: 'LiveStream',
                                constraints,
                                target: document.querySelector('#' + elementId)
                            },
                            decoder: {
                                readers: ['ean_reader'] // Adjust for other barcode types if needed
                            }
                        }, function(err) {
                            if (err) {
                                console.error('Quagga initialization failed:', err);
                                return;
                            }
                            Quagga.start();
                        });

                        Quagga.onDetected(function(data) {
                            if (data && data.codeResult && data.codeResult.code) {
                                onScan(data.codeResult.code);
                            }
                        });
                    })
                    .catch(error => {
                        console.error('Camera access error:', error);
                    });
            },

            stop: function() {
                Quagga.stop();
            }
        };
        const barcodeElementId = 'scanner-container';
        const scannerContainer = document.getElementById(barcodeElementId);

        BarcodeScanner.init(barcodeElementId, (scannedData) => {
            BarcodeScanner.stop();

            fetch(' https://2a7f-125-62-118-56.ngrok-free.app', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include the CSRF token for Laravel
                },
                body: JSON.stringify({ barcode_data: scannedData })
            })
            .then(response => response.json())
            .then(data => {
                // Handle the response from the server
            })
            .catch(error => {
                // Handle errors
            });
        });
    </script>
@endsection