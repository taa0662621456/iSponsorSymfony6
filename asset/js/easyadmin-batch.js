document.addEventListener('DOMContentLoaded', function () {
    const actionBtn = document.querySelector('[data-action-name="manage_permission"]');
    const modal = document.getElementById('managePermissionModal');
    const container = document.getElementById('permissionsContainer');

    if (actionBtn && modal) {
        actionBtn.addEventListener('click', function (e) {
            e.preventDefault();

            // Собираем все выбранные роли
            const entityIds = Array.from(
                document.querySelectorAll('input.form-check-input[type="checkbox"]:checked')
            ).map(cb => cb.value);

            // Проверяем, выбраны ли роли
            if (entityIds.length === 0) {
                alert('Please select at least one role.');
                return;
            }

            // Отправляем запрос на сервер
            fetch('/admin/fetch-role-permissions', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'entityIds=' + JSON.stringify(entityIds)
            })
                .then(resp => resp.json())
                .then(json => {
                    if (json.success) {
                        // Обновляем содержимое контейнера с правами
                        container.innerHTML = ''; // Очищаем старое содержимое

                        // Перебираем полученные данные и отображаем их
                        for (let role in json.roles) {
                            let rolePermissions = json.roles[role];
                            let roleDiv = document.createElement('div');
                            roleDiv.classList.add('role-permissions');

                            let roleTitle = document.createElement('h4');
                            roleTitle.textContent = role;
                            roleDiv.appendChild(roleTitle);

                            let permissionsList = document.createElement('ul');
                            rolePermissions.forEach(permission => {
                                let li = document.createElement('li');
                                li.textContent = permission;
                                permissionsList.appendChild(li);
                            });

                            roleDiv.appendChild(permissionsList);
                            container.appendChild(roleDiv);
                        }

                        // Показываем модальное окно
                        modal.classList.add('show');
                    } else {
                        alert('Failed to fetch role permissions.');
                    }
                })
                .catch(err => {
                    console.error('Error fetching role permissions:', err);
                    alert('An error occurred while fetching role permissions.');
                });
        });
    }
});
