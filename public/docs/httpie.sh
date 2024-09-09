#!/bin/bash

set -euo pipefail

# Retrieve authenticatable details
http --session=session -f POST http://localhost:8000/api/authenticatable/retrieve email=email@email.com

# Send login verification
http --session=session -f POST http://localhost:8000/api/authenticatable/login_verification email=email@email.com password=password url=http://localhost:8000/verifications locale=en

# User login
http --session=session -f POST http://localhost:8000/api/authenticatable/login email=email@email.com password=password

# Get current authenticatable details
http --session=session -f GET http://localhost:8000/api/authenticatable/current

# Logout from current device
http --session=session -f POST http://localhost:8000/api/authenticatable/logout_current_device

# Logout from other devices
http --session=session -f POST http://localhost:8000/api/authenticatable/logout_other_devices password=password

# Logout from all devices
http --session=session -f POST http://localhost:8000/api/authenticatable/logout_all_devices password=password

# Send email verification
http --session=session -f POST http://localhost:8000/api/authenticatable/email_verification email=new@email.com url=http://localhost:8000/verifications locale=en

# Register a new account
http --session=session -f POST http://localhost:8000/api/authenticatable/register email=new@email.com password=password locale=en

# Send account deletion verification
http --session=session -f POST http://localhost:8000/api/authenticatable/delete_verification url=http://localhost:8000/verifications locale=en

# Delete user account
http --session=session -f POST http://localhost:8000/api/authenticatable/delete password=password

# Update account details
http --session=session -f POST http://localhost:8000/api/authenticatable/update locale=en

# Send credentials update verification
http --session=session -f POST http://localhost:8000/api/authenticatable/credentials_update_verification url=http://localhost:8000/verifications locale=en

# Update account credentials
http --session=session -f POST http://localhost:8000/api/authenticatable/credentials_update email=updated@email.com password=password

# Send password reset verification
http --session=session -f POST http://localhost:8000/api/authenticatable/password_reset_verification email=email@email.com url=http://localhost:8000/verifications locale=en

# Reset account password
http --session=session -f POST http://localhost:8000/api/authenticatable/password_reset password=password

# Send password update verification
http --session=session -f POST http://localhost:8000/api/authenticatable/password_update_verification url=http://localhost:8000/verifications locale=en

# Update account password
http --session=session -f POST http://localhost:8000/api/authenticatable/password_update password=password new_password=password

# Invalidate current session
http --session=session -f POST http://localhost:8000/api/sessions/invalidate

# Regenerate session ID
http --session=session -f POST http://localhost:8000/api/sessions/regenerate

# Retrieve verification details
http --session=session -f GET http://localhost:8000/api/verifications/show verification_id==$(read -p "Enter verification_id: " verification_id && echo ${verification_id})

# Complete verification process
http --session=session -f POST http://localhost:8000/api/verifications/complete verification_id=$(read -p "Enter verification_id: " verification_id && echo ${verification_id}) token=1111
