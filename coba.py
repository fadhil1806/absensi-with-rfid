import base64
from Crypto.Cipher import AES
from Crypto.Util.Padding import unpad

# Base64 decoded message (ciphertext)
encrypted_msg = base64.b64decode("RJsRNCyoOlFr9TAfnEll6XOJvDc0TapCp1k00LdTeod5EzusKjYYk4iCWi6I3ASbfo9bJ2qsMe5Ve87xXYsZqg==")

# Kunci enkripsi
key = b'rahasia_ctfr'.ljust(16, b'\0')  # Panjang kunci harus 16 byte untuk AES-128

# IV diambil dari 16 byte pertama ciphertext
iv = encrypted_msg[:16]

# Ciphertext yang sebenarnya
ciphertext = encrypted_msg[16:]

# Dekripsi
cipher = AES.new(key, AES.MODE_CBC, iv)
decrypted_msg = unpad(cipher.decrypt(ciphertext), AES.block_size)

# Output pesan yang didekripsi
print(decrypted_msg.decode('utf-8'))
