import re

def rename_tasks(file_path):
    with open(file_path, 'r', encoding='utf-8') as file:
        content = file.read()

    # Регулярное выражение для поиска заголовков задач
    task_pattern = re.compile(r'(#### \*\*.*?\*\*)', re.DOTALL)
    tasks = task_pattern.findall(content)

    # Переименовать задачи по порядку
    for i, task in enumerate(tasks, start=1):
        new_task = f'#### **{i}. {task[6:]}'
        content = content.replace(task, new_task, 1)

    # Записать изменения обратно в файл
    with open(file_path, 'w', encoding='utf-8') as file:
        file.write(content)

if __name__ == "__main__":
    file_path = '/home/nikola/projects/prostogram/docs/Tasks.md'
    rename_tasks(file_path)
    print(f'Tasks in {file_path} have been renamed successfully.')